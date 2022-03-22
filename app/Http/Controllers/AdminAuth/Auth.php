<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\admins;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    public function register(Request $request)
    {

        $fields = $request->validate([
            'name' =>'required|string',
            'email'=>'required|string|email|unique:users',
            'password' =>'required'
        ]);

        $admins = admins::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>Hash::make($fields['password']),
        ]);

        //create token
        $token = $admins->createToken('token')->plainTextToken;

        $response = [
            'message'=>'registered successfully!',
            'data' =>[
                'admins'=>$admins,
                'token'=>$token
            ]
        ];
        return response($response,201);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required'
        ]);
        $admin= admins::where('email',$fields['email'])->first();
        if(!Hash::check($request->password,$admin->password))
        {
            return response()->json(['status'=>false,'message'=>'invalid email or password'],401);
        }
        $token = $admin->createToken('authtoken')->plainTextToken;
        $response = [
            'message'=>'Login successful!',
            'data' =>[
                'user'=>$admin,
                'token'=>$token
            ]
        ];
        return response()->json($response,201);
    }
    public function profile(Request $request)
    {
        return response()->json(\Illuminate\Support\Facades\Auth::user());
    }
}
