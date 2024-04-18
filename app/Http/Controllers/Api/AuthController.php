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

    public function profile(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'User successfully fetched',
                'data' => $request->user()
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized access',
                'error' => 'User not authenticated'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        \Log::info('User object: ' . print_r($request->user(), true));
        if ($user = $request->user()) {
            $user->tokens()->delete();
            return response()->json([
                'message' => 'User successfully logged out',
            ], 200);
        } else {
            return response()->json([
                'message' => 'No user authenticated',
            ], 401);
        }
    }

    public function updateProfile(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return abort(403, 'Unauthorized'); // User not authenticated
        }
    
        // Get the currently authenticated user's ID
        $userId = Auth::user()->id;
    
        // Validate incoming request data
        $rules = [
            'name' => 'string|max:255', // Make name optional
            'email' => 'email|unique:users,email,' . $userId, // Unique email check
            'password' => 'string|min:6|max:30', // Make password optional 
            'address' => 'string|max:255', // Make address optional 
            'city' => 'string|max:255', // Make city optional
            'postal_code' => 'string|min:4|max:4', // Make postal code optional
            'phone' => 'string|min:3|max:12', // Make phone number optional
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid input',
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Retrieve the user to be updated (using the current user's ID)
        $user = User::findOrFail($userId);
    
        // Check if the user is trying to change their own email to one already taken
        if ($user->email !== $request->email && User::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'Email already taken',
            ], 400);
        }
    
        // Update the user's profile information
        $user->update([
            'name' => $request->name ?? $user->name, // Use existing value if not provided
            'email' => $request->email ?? $user->email, // Same as name
            'password' => $request->password ?? $user->password,
            'address' => $request->address ?? $user->address,
            'city' => $request->city ?? $user->city,
            'postal_code' => $request->postal_code ?? $user->postal_code,
            'phone' => $request->phone ?? $user->phone,
        ]);
    
        // Return a success response
        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user,
            'password' => $request->password
        ], 200);
    }

    public function deleteProfile(Request $request)
    {
        // Get the currently authenticated user's ID
        $userId = Auth::user()->id;
    
        // Retrieve the user to be deleted
        $user = User::findOrFail($userId);
    
        // Delete the user (soft delete)
        $user->delete();
    
        // Return a success response
        return response()->json([
            'message' => 'Your profile has been deleted successfully',
        ], 200);
    }

}
