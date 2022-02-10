<?php

namespace App\Imports;

use App\Models\Establishment;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstablishmentsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new Establishment([
            'name'=> $row['name'],
        ]);
    }
}
