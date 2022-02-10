<?php

namespace App\Imports;

use App\Models\Candidacy;
use App\Mail\CandidacyResultMail;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CandidaciesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $candidacy = Candidacy::find($row['id']);
        $candidacy->update(['result'=> $row['result']]);
        Mail::to($candidacy->email)->send(new CandidacyResultMail($candidacy));
        return $candidacy;
    }
}
