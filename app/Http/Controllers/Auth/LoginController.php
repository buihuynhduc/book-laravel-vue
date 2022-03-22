<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
           'email'=>'required|string|email',
           'password'=>'required'
        ]);
        $user= User::where('email',$fields['email'])->first();
        if(!Hash::check($request->password,$user->password))
        {
            return response()->json(['status'=>false,'message'=>'invalid email or password'],401);
        }
        $token = $user->createToken('authtoken')->plainTextToken;
        $response = [
            'message'=>'Login successful!',
            'data' =>[
                'user'=>$user,
                'token'=>$token
            ]
        ];
        return response()->json($response,201);
    }
}
