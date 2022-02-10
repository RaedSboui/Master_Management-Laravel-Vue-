<?php

namespace App\Exports;

use App\Models\Diploma;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DiplomasExport implements FromQuery, WithHeadings
{
    use Exportable;
    protected $diplomas;

    public function __construct($diplomas)
    {
        $this->diplomas = $diplomas;
    }

    public function headings():array{
        return['Id', 'Name', 'Years', 'Minimum years', 'Credits', 'SFE', 'Created_at', 'Updated_at'];
    }

    public function query()
    {
        return Diploma::query()->whereKey($this->diplomas);
    }
}
