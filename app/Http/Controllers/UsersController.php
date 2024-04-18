<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user === null) {
            return response()->json(['error' => 'A Felhasználó nem található'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30',
            'address' => 'required|min:5|max:100',
            'city' => 'required|min:2|max:50',
            'postal_code' => 'required|min:4|max:4',
            'phone' => 'required|min:3|max:12',
            'admin' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ], 422);
        }
        else{
            $user = User::where('id', $id)->get();

            $user=User::update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'address'=>$request->address,
                'city'=>$request->city,
                'postal_code'=>$request->postal_code,
                'phone'=>$request->phone,
                'admin'=>$request->admin
            ]);
        }
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);

        $order->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
