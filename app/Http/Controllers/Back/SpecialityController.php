<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreSpecialityRequest;
use App\Exports\SpecialitiesExport;
use App\Imports\SpecialitiesImport;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::all();
        return response()->json(['specialities' => $specialities]);
    }

    public function store(UpdateStoreSpecialityRequest $request)
    {
        $speciality = Speciality::create($request->all());
        return response()->json(['message' => 'Speciality created succesfully !', 'speciality' => $speciality]);
    }

    public function update(UpdateStoreSpecialityRequest $request, Speciality $speciality)
    {
        $speciality->update($request->all());
        return response()->json(['message' => 'Speciality updated succesfully !']);
    }

    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        return response()->json(['message' => 'Speciality deleted succesfully !']);
    }

    public function deleteMultiple($specialities)
    {
        Speciality::whereIn('id', $specialities = explode(',', $specialities))->delete();
        return response()->json(['message'=>count($specialities).' Selected Specialities deleted succesfully !']);
    }

    public function export($specialities) 
    {
        return (new SpecialitiesExport(explode(',', $specialities)))->download('specialities.xlsx');
    }

    public function import(Request $request) 
    {
        (new SpecialitiesImport)->import($request->file('import'));
        return response()->json(['message'=>'Data imported succesfully !']);        
    }
}
