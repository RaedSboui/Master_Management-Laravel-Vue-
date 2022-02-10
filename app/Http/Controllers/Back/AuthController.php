<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $credentials = $request->only('username','password');
        if(!$token = Auth::guard('admin-api')->attempt($credentials))
        {
            return response()->json(['success'=>false], 401);
        }
        $user = Auth::guard('admin-api')->user();
        $user->update(['isConnected' => true]);
        $user->roles;
        return response()->json(['success'=>true,'token'=>$token, 'user'=>$user]);
    }

    public function checkToken() 
    {
        return response()->json(['success'=>true], 200);
    }

    public function logout()
    {
        $user = Auth::guard('admin-api')->user();
        $user->update(['isConnected' => false]);
        auth()->logout();
        return response()->json(['success'=>true], 200);
    }
}
