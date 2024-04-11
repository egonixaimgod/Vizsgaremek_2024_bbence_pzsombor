<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
            'address' => 'required|min:5|max:100',
            'county' => 'required|min:2|max:50',
            'city' => 'required|min:2|max:50',
            'postal_code' => 'required|min:4|max:4',
            'phone' => 'required|min:3|max:12',
            'admin' => 'false'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ], 422);
        }

        $customer=Customer::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'address'=>$request->address,
            'city'=>$request->city,
            'county'=>$request->county,
            'postal_code'=>$request->postal_code,
            'phone'=>$request->phone,
            'admin'=>'false'
        ]);
        
        return response()->json([
            'message'=>'Registration succesful',
            'data'=>$customer
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

        $customer=Customer::where('email',$request->email)->first();

        if($customer){
            if(Hash::check($request->password,$customer->password)){

                $token=$customer->createToken('auth-token')->plainTextToken;
                return response()->json([
                    'message'=>'Login succesful',
                    'token'=>$token,
                    'data'=>$customer
                ], 400);
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
}
