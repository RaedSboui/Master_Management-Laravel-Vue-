<?php

namespace App\Exports;

use App\Models\Establishment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EstablishmentsExport implements FromQuery, WithHeadings
{
    use Exportable;
    protected $establishments;

    public function __construct($establishments)
    {
        $this->establishments = $establishments;
    }

    public function headings():array{
        return['Id', 'Name', 'Created_at', 'Updated_at'];
    }

    public function query()
    {
        return Establishment::query()->whereKey($this->establishments);
    }
}
