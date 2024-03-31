<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

// I know that a better practice is to seperate between routes (user, messages).
// I had an issue that the app didn't recognize other routes but /api.
// If I had more time, I would investigate the issue and seperate the routes 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    return 'Hello World';
});

Route::post('/signup', [UserController::class, 'signup']);

Route::post('/login', [UserController::class, 'login']);

// Protect the route - only users with a token can post a message
Route::middleware('auth:sanctum')->post('/messages', [MessageController::class, 'index']);
