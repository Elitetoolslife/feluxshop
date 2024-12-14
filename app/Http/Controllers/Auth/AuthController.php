<?php 

namespace App\Http\Controllers\Auth;

   use App\Http\Controllers\Controller;
   use App\Models\User;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Facades\Validator;

   class AuthController extends Controller
   {
       public function register(Request $request)
       {
           $validator = Validator::make($request->all(), [
               'username' => 'required|string|max:16|unique:users',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|min:6|confirmed',
           ]);

           if ($validator->fails()) {
               return response()->json(['errors' => $validator->errors()], 422);
           }

           $user = User::create([
               'username' => $request->username,
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'ip' => $request->ip(),
           ]);

           return response()->json(['success' => 'Registration successful'], 201);
       }

       public function login(Request $request)
       {
           $credentials = $request->only('email', 'password');

           if (Auth::attempt($credentials)) {
               $request->session()->put('username', Auth::user()->username);
               $request->session()->put('balance', Auth::user()->balance);

               return response()->json(['success' => 'Login successful'], 200);
           }

           return response()->json(['error' => 'Login failed'], 401);
       }
   }