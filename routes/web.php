<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('login', [AuthController::class, 'loginForm']);  // Login form
Route::post('login', [AuthController::class, 'login']);  // Login attempt
Route::get('home', [HomeController::class, 'index'])->middleware('auth');  // Dashboard



Route::get('/', function () {
    return view('welcome');
});
