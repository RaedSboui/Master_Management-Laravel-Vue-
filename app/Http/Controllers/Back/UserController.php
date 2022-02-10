<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStoreUserRequest;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return response()->json(['users' => $users]);
    }
   
    public function store(UpdateStoreUserRequest $request)
    {
        $user = (new UpdateStoreUserRequest)->store($request);
        return response()->json(['message'=>'User created succesfully !', 'user'=>$user, ]);
    }

    public function show(User $user)
    {
        return response()->json(['user' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $user = (new UpdateStoreUserRequest)->update($request, $user);
        return response()->json(['message'=>'User updated succesfully !', "user"=>$user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'User deleted succesfully !']);
    }

    public function deleteMultiple($users)
    {
        User::whereIn('id', $users = explode(',', $users))->delete();
        return response()->json(['message'=>count($users).' Selected Users deleted succesfully !']);
    }

    public function export($users) 
    {
        return (new UsersExport(explode(',', $users)))->download('users.xlsx');
    }

    public function import(Request $request) 
    {
        (new UsersImport)->import($request->file('import'));
        return response()->json(['message'=>'Data imported succesfully !']);        
    }
}
