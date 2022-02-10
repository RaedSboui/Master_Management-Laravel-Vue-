<?php

namespace App\Exports;

use App\Models\Candidacy;
use Maatwebsite\Excel\Concerns\FromCollection;

class CandidacyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Candidacy::all();
    }
}
