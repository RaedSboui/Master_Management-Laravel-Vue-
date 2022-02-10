<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $credentials = $request->only('identity','password');
        if(!$token = Auth::guard('candidate-api')->attempt($credentials))
        {
            return response()->json(['success'=>false], 401);
        }
        $candidate = Auth::guard('candidate-api')->user();
        return response()->json(['success'=>true,'token'=>$token, 'candidacy_id'=>$candidate->candidacy_id]);
    }

    public function checkToken() 
    {
        return response()->json(['success'=>true], 200);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['success'=>true], 200);
    }
}
