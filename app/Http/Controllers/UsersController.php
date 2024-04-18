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

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30',
            'address' => 'required|min:5|max:100',
            'city' => 'required|min:2|max:50',
            'postal_code' => 'required|min:4|max:4',
            'phone' => 'required|min:3|max:12',
            'admin' => 'required|boolean'
        ]);

        $user->update($request->all());
        return response()->json($user, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);

        $order->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
