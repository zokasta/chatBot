<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();  // ✅ Session regenerate karo

            return redirect()->route('chatbot')->with('success', 'Login successful');

        }

        return back()->withErrors(['email' => 'Invalid credentials.']);


    }


    public function dashboard()
    {
        return view('greating'); // Ensure 'index' is the correct chatbot page
    }

}
