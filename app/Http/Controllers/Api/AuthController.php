<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30',
            'confirm_password' => 'required|same:password',
            'address' => 'required|min:5|max:100',
            'city' => 'required|min:2|max:50',
            'postal_code' => 'required|min:4|max:4',
            'phone' => 'required|min:3|max:12',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ], 422);
        }
    
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'address'=>$request->address,
            'city'=>$request->city,
            'postal_code'=>$request->postal_code,
            'phone'=>$request->phone,
            'admin'=>false
        ]);
        
        return response()->json([
            'message'=>'Registration succesful',
            'data'=>$user
        ],200);
    }    

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ], 422);
        }

        $user=User::where('email',$request->email)->first();

        if($user){
            if(Hash::check($request->password,$user->password)){

                $token=$user->createToken('auth-token')->plainTextToken;
                return response()->json([
                    'message'=>'Login succesful',
                    'token'=>$token,
                    'data'=>$user
                ], 200);
            }else{
                return response()->json([
                    'message'=>'Incorrect password',
                ], 400);
            }
        }else{
            return response()->json([
                'message'=>'Incorrect credentials',
            ], 400);
        }
    }

    public function user(Request $request){
        return response()->json([
            'message'=>'User succesfully fetched',
            'data'=>$request->user()
        ], 200);
    }

    public function logout(Request $request){
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'User successfully logged out',
            ], 200);
        } else {
            return response()->json([
                'message' => 'No user authenticated',
            ], 401);
        }
    }

}
