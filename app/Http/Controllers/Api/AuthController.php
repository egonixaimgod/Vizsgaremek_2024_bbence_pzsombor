<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        /*$request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|max:100',
            'address' => 'required|min:5|max:100',
            'county' => 'required|min:2|max:50',
            'city' => 'required|min:2|max:50',
            'postal_code' => 'required|min:4|max:4',
            'phone' => 'required|min:12|max:12',
            'admin' => 'false'
        ]);*/

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6|max:100',
            'address' => 'required|min:5|max:100',
            'county' => 'required|min:2|max:50',
            'city' => 'required|min:2|max:50',
            'postal_code' => 'required|min:4|max:4',
            'phone' => 'required|min:12|max:12',
            'admin' => 'false'
        ]);
        
        if ($validator->fails()) {
            return respone()->json([
                'message'=>'Validation fails',
                'errors' => $validator->errors()
            ],400);
        }
        
    }
}
