<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreEstablishmentRequest;
use App\Exports\EstablishmentsExport;
use App\Imports\EstablishmentsImport;
use App\Models\Establishment;
use Illuminate\Http\Request;




class EstablishmentController extends Controller
{
    public function index()
    {
        $establishments = Establishment::all();
        return response()->json(['establishments' => $establishments]);
    }

    public function store(UpdateStoreEstablishmentRequest $request)
    {
        $establishment = Establishment::create($request->all());
        return response()->json(['message'=>'Establishment created succesfully !', 'establishment'=>$establishment, ]);
    }

    public function update(UpdateStoreEstablishmentRequest $request, Establishment $establishment)
    {
        $establishment->update($request->all());
        return response()->json(['message'=>'Establishment updated succesfully !']);
    }

    public function destroy(Establishment $establishment)
    {
        $establishment->delete();
        return response()->json(['message'=>'Establishment deleted succesfully !']);
    }

    public function deleteMultiple($establishments)
    {
        Establishment::whereIn('id', $establishments = explode(',', $establishments))->delete();
        return response()->json(['message'=>count($establishments).' Selected Establishments deleted succesfully !']);
    }

    public function export($establishments) 
    {
        return (new EstablishmentsExport(explode(',', $establishments)))->download('establishments.xlsx');
    }

    public function import(Request $request) 
    {
        (new EstablishmentsImport)->import($request->file('import'));
        return response()->json(['message'=>'Data imported succesfully !']);        
    }
}
