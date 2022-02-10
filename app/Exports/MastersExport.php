<?php

namespace App\Exports;

use App\Models\Master;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class MastersExport implements FromQuery, WithHeadings
{
    use Exportable;
    protected $masters;

    public function __construct($masters)
    {
        $this->masters = $masters;
    }

    public function headings():array{
        return['Id', 'Title', 'Is Active', 'Description', 'Created By', 'Created_at', 'Updated_at'];
    }

    public function query()
    {
        return Master::query()->whereKey($this->masters);
    }
}
