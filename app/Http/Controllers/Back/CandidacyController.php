<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreCandidacyRequest;
use App\Models\Candidacy;
use App\Exports\CandidaciesExport;
use App\Imports\CandidaciesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CandidacyController extends Controller
{
    public function index()
    {
        $candidacies = (new UpdateStoreCandidacyRequest)->index();
        return response()->json(['candidacies' => $candidacies]);
    }

    public function store(UpdateStoreCandidacyRequest $request)
    {
        $candidacy = (new UpdateStoreCandidacyRequest)->store($request);
        return response()->json(['message'=>'Candidacy created succesfully !', 'candidacy'=>$candidacy]);
    }

    public function show(Candidacy $candidacy)
    {
        $candidacy = (new UpdateStoreCandidacyRequest)->show($candidacy);
        return response()->json([$candidacy]);
    }

    public function update(UpdateStoreCandidacyRequest $request, Candidacy $candidacy)
    {
        $candidacy = (new UpdateStoreCandidacyRequest)->update($request, $candidacy);
        return response()->json(['message'=>'Candidacy updated succesfully !', 'candidacy'=>$candidacy]);
    }

    public function destroy(Candidacy $candidacy)
    {
        $candidacy->delete();
        return response()->json(['message'=>'Candidacy deleted succesfully !']);
    }

    public function deleteMultiple($candidacies)
    {
        Candidacy::whereIn('id', $candidacies = explode(',', $candidacies))->delete();
        return response()->json(['message'=>count($candidacies).' Selected Candidacies deleted succesfully !']);
    }

    public function export($masterID) 
    {
        return Excel::download(new CandidaciesExport($masterID), 'candidacies.xlsx');
    }

    public function import(Request $request) 
    {
        (new CandidaciesImport)->import($request->file('import'));
        return response()->json(['message'=>'Data imported succesfully !']);        
    }

}
