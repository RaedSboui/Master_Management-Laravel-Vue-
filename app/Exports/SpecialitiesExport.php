<?php

namespace App\Exports;

use App\Models\Speciality;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SpecialitiesExport implements FromQuery, WithHeadings
{
    use Exportable;
    protected $specialities;

    public function __construct($specialities)
    {
        $this->specialities = $specialities;
    }

    public function headings():array{
        return['Id', 'Name', 'Created_at', 'Updated_at'];
    } 

    public function query()
    {
        return Speciality::query()->whereKey($this->specialities);
    }
}