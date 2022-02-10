<?php

namespace App\Imports;

use App\Models\Master;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MastersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
            return new Master([
                'title'=>$row['title'],
                'isActive'=>$row['is_active'] ,
                'description'=>$row['description'],
                'createdBy'=>$row['created_by']
            ]);
    }
}
