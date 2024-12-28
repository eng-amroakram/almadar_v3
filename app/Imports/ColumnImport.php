<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class ColumnImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        $bcodeR = $rows->take(3526)->pluck('bcoder')->toArray();
        $bcodeRf = $rows->take(448)->pluck('bcoderf')->toArray();
        $bcode_names_r = $rows->take(3526)->pluck('bcodenamesr')->toArray();
        $bcode_names_rf = $rows->take(448)->pluck('bcodenamesrf')->toArray();
    }

    public function chunkSize(): int
    {
        return 100; // You can adjust this chunk size as needed
    }
}
