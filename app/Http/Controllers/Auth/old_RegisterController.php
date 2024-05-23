<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ActivationMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function showRegistrationForm(){
        return view('auth.register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15', // Make phone field required
            'organization_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
        ]);

        $userId = strtoupper(Str::random(5)); // Generate 5-digit alphanumeric user ID
        $password = Str::random(12); // Generate 12-character random password
        $activationToken = Str::random(60); // Generate activation token

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'organization_name' => $request->organization_name,
            'designation' => $request->designation,
            'user_id' => $userId,
            'password' => $password, // Hash the password
            'activation_token' => $activationToken, // Save activation token
            'whatsapp_number' => $request->whatsappnumber,
        ]);


        // Send activation email
        $activationLink = url()->signedRoute('activate', ['user' => $user->id]);
        Mail::to($user->email)->send(new ActivationMail($user, $activationLink));

        // You can send email with password to user here

        return redirect()->route('auth.thank-regis');
    }
}
