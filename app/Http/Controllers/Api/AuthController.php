<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller{

	public function Register(Request $request){
		$registerUserData = Validator::make($request->all(),[
	        'name'=>'required|string',
	        'email'=>'required|string|email|unique:admin_users',
	        'password'=>'required|min:8'
	    ]);
        if($registerUserData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $registerUserData->errors()
            ], 401);
        }
        Log::warning('sss');
	    $user = User::create([
	        'name' => $request['name'],
	        'email' => $request['email'],
	        'password' => Hash::make($request['password']),
	    ]);
	    return response()->json([
	        'message' => 'User Created ',
	    ]);
	}

	public function Login(Request $request){
		Log::warning($request);
		Log::warning("request");
	 	$loginUserData = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required|min:8'
        ]);
        if($loginUserData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $loginUserData->errors()
            ], 401);
        }
  
        $user = (new User())->validateUserIdentity($request);
        Log::warning($user);
        Log::warning("user");
        if(!$user){
            return response()->json([
                'message' => 'You are not registered with us'
            ],401);
        }
        if(!Hash::check($request['password'],$user->password)){
        	return response()->json([
                'message' => 'Wrong password'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'status'=>true,
            'access_token' => $token,
        ]);
	}

	public function Logout(Request $request){
		$request->user()->currentAccessToken()->delete();
      	return response()->json(
          [
              'status' => 'success',
              'message' => 'User logged out successfully'
          ]);
	}
}

