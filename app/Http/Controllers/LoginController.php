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
            // dd(Auth::user());
            return redirect()->route('chatbot')->with('success', 'Login successful');

        }


        // dd("Login Failed!"); // Debugging: Check if login is failing

        
        return back()->withErrors(['email' => 'Invalid credentials.']);


    }
    // $credentials = $request->only('email', 'password');

    // if (Auth::attempt($credentials)) {
//     return redirect()->route('chatbot')->with('success', 'Login successful!');
// }

    // return back()->withErrors(['email' => 'Invalid credentials']);
// }

    // public function logout() {
// Auth::logout();
// return redirect('/register')->with('success', 'Logged out successfully!');
// }

public function dashboard() {
    return view('index'); // Ensure 'index' is the correct chatbot page
}


    // protected function authenticated(Request $request, $user)
// {
//     return redirect()->away('chatbot');

    // }




}
