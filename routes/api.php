<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\SendEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Login 
Route::POST('register', [AuthController::class, 'register'])->name('register');
// Register
Route::POST('login',    [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    // logout
    Route::POST('/logout', [AuthController::class, 'logout']);
    // posts
    Route::apiResource('posts', PostsController::class);
    // send emails
    Route::POST('send-emails', [SendEmailController::class, 'sendEmail']);
});

