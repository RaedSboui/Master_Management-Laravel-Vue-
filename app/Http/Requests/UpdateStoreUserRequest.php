<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateStoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'username'=>'required|min:3',
            'password'=>'required',
            'role'=>'required'
        ];
    }

    public function store(Request $request)
    {
        $inputs = $request->except('role');
        $inputs['password'] = Hash::make($inputs['password']);
        $user = User::create($inputs);
        $role = Role::where ('name', $request->role)->first();
        $user->roles()->attach($role->id);
        $user->role = $role->name;
        return $user;
    }

    public function update(Request $request, User $user)
    {  
        $inputs=$request->all();

        if($photo=$request->get("image")){
            if($user->image != "avatar.jpg") unlink('avatars/'.$user->image);
            $newfile=strtotime(date("Y-m-d H:i:s")).".".$photo->getClientOriginalExtension();
            $photo->move('avatars/',$newfile);
            $inputs['image']=$newfile;
        }
        
        if(auth()->user()->id === $user->id) {
            if($user->password === $inputs['password']) {
                $user->update($inputs);
            }else {
                $inputs['password'] = Hash::make($inputs['password']);
                $user->update($inputs);
            }
        }else {
            $user->roles()->detach();
            $role = Role::where ('name', $inputs->role)->first();
            $user->roles()->attach($role->id);
            $user->isLocked = $inputs->get('isLocked');
            $user->save();
        }

        return $request->get("image");
    }
}
