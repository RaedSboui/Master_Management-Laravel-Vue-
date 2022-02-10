<?php

namespace App\Imports;

use App\Models\Diploma;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DiplomasImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new Diploma([
            'name'=> $row['name'],
            'years'=> $row['years'],
            'years_min'=> $row['minimum_years'] ,
            'credits'=> $row['credits'],
            'sfe'=> $row['sfe']
        ]);
    }
}
