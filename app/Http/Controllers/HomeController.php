<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Ensure users must be authenticated
    }

    /**
     * Show the application dashboard with user information and session data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Optionally retrieve session data (username and balance)
        $username = session('username');
        $balance = session('balance');

        // Return the home view with user and session data
        return view('home', compact('user', 'username', 'balance'));
    }

    // If the home method is redundant, you can remove it. Alternatively, 
    // you could add a condition to check which set of data should be passed.
    // public function home() {
    //     $username = session('username');
    //     $balance = session('balance');
    //     return view('home', compact('username', 'balance'));
    // }
}