<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;

   Route::post('/register', [AuthController::class, 'register']);
   Route::post('/login', [AuthController::class, 'login']);
Route::get('home', [HomeController::class, 'index'])->middleware('auth');  // Dashboard



Route::get('/', function () {
    return view('welcome');
});
