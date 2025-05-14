<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	// $request->validated();

    	$userData = [
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => hash::make($request->password),
        ];

    	$user = User::create($userData);
    	$token = $user->createToken('apptoken')->plainTextToken;
    	return response([
        	'users' => $user,
        	'token' => $token
        ],201);
    }

	public function login(Request $request)
    {
    	// $request->validated();

    	$user = User::whereEmail($request->email)->first();

    	if(!$user || !Hash::check($request->password, $user->password)){
        	return response([
            	'message' => 'Invalid credentials',
            ],422);
        }

    	$token = $user->createToken('apptoken')->plainTextToken;

    	return response([
        	'users' => $user,
        	'token' => $token
        ],200);
    }

}
