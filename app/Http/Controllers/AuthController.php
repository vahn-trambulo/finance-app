<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        // Check if user exists first
        if (!$user) {
            return redirect('/login?error=username_not_found');
        }

        // Check password directly and safely
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect('/login?error=incorrect_password');
        }

        return app('view')->make('/users');
    }

        
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function registerSave(Request $request)
    {       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        
        return app('view')->make('/users');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);  // Find user by ID
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->username = $request->username;

        // Update password only if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();  // Save the updated user

        return response()->json(['message' => 'User updated successfully']);
    }
    
    public function logout()
    {
        return app('view')->make('layouts.app');
    }
}