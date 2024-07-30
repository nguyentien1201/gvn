<?php

namespace App\Imports;

use App\Models\GreenBeta;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToArray;

class GreenBetaImport implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow,WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new GreenBetaImport(), // Import từng sheet theo chỉ số
        ];
    }
    public function collection(Collection $collection)
    {

        foreach ($collection as $key => $row) {
            $c = new GreenBeta();
            $c['price_open'] = $row['price_open'];
            $c['open_time'] = $row['open_time'];
            $c['signal_close'] = $row['signal_close'];
            $c['price_close'] = $row['price_close'];
            $c['profit'] = $row['profit'];
            $c['close_time'] = $row['close_time'];
            $c->save();
        }
        return null;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
