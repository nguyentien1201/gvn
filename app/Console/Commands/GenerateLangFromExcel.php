<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GenerateLangFromExcel extends Command
{
    protected $signature = 'lang:generate-from-excel';
    protected $description = 'Generate language files from Excel sheet';

    public function handle()
    {
        $filePath = storage_path('app/public/lang/lang.xlsx'); // put your Excel file here
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $langs = [
            'en' => [],
            'vi' => [],
            'zh' => [],
            'es' => [],
        ];

        foreach ($rows as $index => $row) {
            if ($index === 1) continue; // Skip header row

            $key = $row['A'] ?? null;
            if (!$key) continue;

            $langs['en'][$key] = $row['B'] ?? '';
            $langs['vi'][$key] = $row['C'] ?? '';
            $langs['zh'][$key] = $row['D'] ?? '';
            $langs['es'][$key] = $row['E'] ?? '';
        }

        foreach ($langs as $locale => $translations) {
            $filePath = resource_path("lang/{$locale}.php");
            $content = "<?php\n\nreturn [\n";
            foreach ($translations as $key => $value) {
                $safeValue = addslashes($value);
                $content .= "    '{$key}' => '{$safeValue}',\n";
            }
            $content .= "];\n";

            file_put_contents($filePath, $content);
            $this->info("Generated: {$filePath}");
        }

        $this->info("All language files generated successfully.");
    }
}
