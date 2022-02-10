<?php

namespace App\Imports;

use App\Models\Speciality;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SpecialitiesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new Speciality([
            'name'=> $row['name'],
        ]);
    }
}
