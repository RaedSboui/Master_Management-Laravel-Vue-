<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Candidacy;
use App\Models\Master;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $admins = User::with('roles')->get();
        $masters = Master::select('masters.*', DB::raw('(SELECT COUNT(DISTINCT(candidacy_id)) 
        FROM choices WHERE choices.master_id = masters.id) AS candidacies' ))->get();
        $candidacies = Candidacy::all()->count();
        $tasks = Task::orderBy('created_at', 'DESC')->get();

        return response()->json(['admins' => $admins, 'masters' => $masters, 'candidacies' => $candidacies, 'tasks' => $tasks]);
    }

    public function storeTask(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json(['message'=>'Task created succesfully !', 'task'=>$task]);
    }

    public function updateTask(Request $request, Task $task)
    {
        $task->completed = $request->completed;
        $task->completed_at = $request->completed ? Carbon::now() : null;
        $task->save();
        return response()->json(['message'=>'Task updated succesfully !', 'task'=>$task]);
    }

    public function destroyTask(Task $task)
    {
        $task->delete();
        return response()->json(['message'=>'Task deleted succesfully !']);
    }
}
