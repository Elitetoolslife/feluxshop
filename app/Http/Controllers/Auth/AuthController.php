<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handle the login attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve the credentials from the request
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Store username and balance in the session if authentication is successful
            $request->session()->put('username', Auth::user()->username);
            $request->session()->put('balance', Auth::user()->balance);

            // Redirect the user to the intended route or home page
            return redirect()->intended('home');
        }

        // Redirect back to the login page with an error message if authentication fails
        return redirect('login')->withErrors('Login failed!');
    }
}