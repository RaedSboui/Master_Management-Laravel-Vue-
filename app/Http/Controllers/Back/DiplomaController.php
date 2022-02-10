<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreDiplomaRequest;
use App\Exports\DiplomasExport;
use App\Imports\DiplomasImport;
use App\Models\Diploma;
use Illuminate\Http\Request;

class DiplomaController extends Controller
{
    public function index()
    {
        $diplomas = Diploma::all();
        return response()->json(['diplomas' => $diplomas]);
    }

    public function store(UpdateStoreDiplomaRequest $request)
    {
        $diploma = Diploma::create($request->all());
        return response()->json(['message'=>'Diploma created succesfully !', 'diploma'=>$diploma]);
    }

    public function update(UpdateStoreDiplomaRequest $request, Diploma $diploma)
    {
        $diploma->update($request->all());
        return response()->json(['message'=>'Diploma updated succesfully !']);
    }

    public function destroy(Diploma $diploma)
    {
        $diploma->delete();
        return response()->json(['message'=>'Diploma deleted succesfully !']);
    }

    public function deleteMultiple($diplomas)
    {
        Diploma::whereIn('id', $diplomas = explode(',', $diplomas))->delete();
        return response()->json(['message'=>count($diplomas).' Selected Diplomas deleted succesfully !']);
    }

    public function export($diplomas) 
    {
        return (new DiplomasExport(explode(',', $diplomas)))->download('diplomas.xlsx');
    }

    public function import(Request $request) 
    {
        (new DiplomasImport)->import($request->file('import'));
        return response()->json(['message'=>'Data imported succesfully !']);        
    }
}
