<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Event Routes
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);

// Authentication Routes (Sanctum)
Route::post('/login', [AuthController::class, 'login']);  // Login route to authenticate user and issue token

// Authenticated User Routes (requires Sanctum token)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();  // Returns authenticated user's details
});
