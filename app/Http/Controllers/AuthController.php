<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

         
        $token = auth()->attempt($credentials);

        // if (! $token = JWTAuth::fromUser($user)) { 
        //     return response()->json(['error' => 'invalid_credentials'], 401);

        // // if (!$token = JWTAuth::attempt($credentials)) {
        //     // return 'Invalid login details';
        //  }

        return response()->json(compact('token')); 

    }


    public function logout(Request $request)
    {
        $forever=true;
        auth()->parseToken()->invalidate( $forever );
        return response()->json(['logout'=>true]); 
 
    }


    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required|between:8,255',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
}
