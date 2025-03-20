<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log; // Log ke liye

class RegisterController extends Controller
{


    public function register(Request $request)
    {
        // Log::info('Register function called'); // Debug ke liye

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Log::info('Validation Passed'); // Debug ke liye

        // Avatar Upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = null;
        }

        // Log::info('Avatar Upload Done'); // Debug ke liye

        // Create User
        // $user =
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        // Log::info('User Created: ' . json_encode($user)); // Debug ke liye

        // auth()->login($user);

        // Log::info('User Logged In'); // Debug ke liye
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');

    }

}
