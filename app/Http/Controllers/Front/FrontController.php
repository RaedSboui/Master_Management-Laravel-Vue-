<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Models\Diploma;
use App\Models\Establishment;
use App\Models\Speciality;
use App\Models\Candidacy;
use App\Http\Requests\UpdateStoreCandidacyRequest;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Dompdf;

class FrontController extends Controller
{
    public function index()
    {
        $masters = Master::all();
        $diplomas = Diploma::all();
        $establishments = Establishment::all();
        $specialities = Speciality::all();
        return response()->json(['masters' => $masters, 'diplomas' => $diplomas, 'establishments' => $establishments,'specialities' => $specialities]);
    }

    public function getMasters()
    {
        $masters = Master::all();
        return response()->json(['masters' => $masters]);
    }

    public function printCandidacy(Candidacy $candidacy)
    {
        /*
        \Spatie\Browsershot\Browsershot::url("http://master.test")
            ->setNodeBinary("C:\\nodejs\\node.exe")
            ->setNpmBinary("C:\\nodejs\\npm.exe")
            ->waitUntilNetworkIdle()
            ->noSandbox()
            ->usePipe()
            ->ignoreHttpsErrors()->timeout(500)->pdf("candidacy.pdf");
        */

        $data = (new UpdateStoreCandidacyRequest)->show($candidacy);
        $pdf = PDF::loadView('candidacy', $data);
        //$pdf->save(public_path() .'/images/master_candidacy_n°'.$data['candidacy']->id.'.pdf');
        return $pdf->output();
    }
}
