<?php

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreMasterRequest;
use App\Exports\MastersExport;
use App\Imports\MastersImport;
use App\Models\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MasterController extends Controller
{
    public function index()
    {
        $masters = Master::select('masters.*', DB::raw('(SELECT COUNT(DISTINCT(candidacy_id)) 
        FROM choices WHERE choices.master_id = masters.id) AS candidacies' ))->get(); 
        return response()->json(['masters' => $masters]);
    }

    public function store(UpdateStoreMasterRequest $request)
    {
        $master = Master::create($request->all());
        $master->candidacies = 0;
        return response()->json(['message'=>'Master created succesfully !', 'master'=>$master]);
    }

    public function show( Master $master)
    {
        $master->subjects;
        return response()->json(['master'=>$master]);
    }

    public function update(UpdateStoreMasterRequest $request, Master $master)
    {
        $master->update($request->except('candidacies'));
        return response()->json(['message'=>'Master updated succesfully !']);
    }

    public function destroy(Master $master)
    {
        $master->delete();
        return response()->json(['message'=>'Master deleted succesfully !']);
    }

    public function deleteMultiple($masters)
    {
        Master::whereIn('id', $masters = explode(',', $masters))->delete();
        return response()->json(['message'=>count($masters).' Selected Masters deleted succesfully !']);
    }

    public function export($masters) 
    {
        return (new MastersExport(explode(',', $masters)))->download('masters.xlsx');
    }

    public function import(Request $request) 
    {
        (new MastersImport)->import($request->file('import'));
        return response()->json(['message'=>'Data imported succesfully !']);        
    }
}
