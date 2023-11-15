<?php

use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\UserController;

// Home route returns a welcome message
Route::get('/home', function () {
    return response()->json(['message' => 'Welcome to the API'], 200);
});

// Public routes

// Register route
Route::post('/register', [registerController::class, 'register']);
// Login route
Route::post('/login', [loginController::class, 'login']);
// Logout route
Route::middleware('auth:sanctum')->post('/logout', [logoutController::class, 'logout']);

// Role-based routes


// Hospital owner route
Route::middleware(['auth:sanctum', 'checkHospitalOwner', 'verifiedHospital'])->post('/add-docs', [HospitalController::class, 'addDocs']);

// User route

// Common route for both user and hospital owner
Route::middleware(['auth:sanctum'])->post('/add-temp', [CommonController::class, 'addTemp']);


