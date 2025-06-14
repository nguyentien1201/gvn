<?php

namespace App\Imports;

use App\Models\Users;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow
{

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            $regex = ['(', ')', '-', ' '];
            $c = new Customer();
            $c['first_name'] = $row['wpcf_first_name'];
            $c['last_name'] = $row['wpcf_last_name'];
            $c['phone_number'] = str_replace($regex, "", $row['wpcf_phone_number']);
            $c['address'] = $row['wpcf_address'];
            $c['email'] = $row['wpcf_email'];
            $c['note'] = $row['wpcf_note'];
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
