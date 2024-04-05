<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/v1/auth/login',[UserAuthController::class, 'login']);
Route::get('/v1/auth/users',[UserAuthController::class, 'index']);
Route::post('/v1/auth/logout',[UserAuthController::class, 'logout'])->middleware('auth:sanctum');
