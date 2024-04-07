<?php
namespace App\Http\Controllers;

use App\Models\MedicationInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/v1/auth/login',[UserAuthController::class, 'login']);
Route::get('/v1/auth/users',[UserAuthController::class, 'index'])->middleware('auth:sanctum');
Route::post('/v1/auth/logout',[UserAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/v1/customers', [CustomerRecordController::class, 'index'])->middleware('auth:sanctum');
Route::post('/v1/customers', [CustomerRecordController::class, 'store'])->middleware('auth:sanctum');
Route::get('/v1/customers/{id}', [CustomerRecordController::class, 'show'])->middleware('auth:sanctum');
Route::put('/v1/customers/{id}', [CustomerRecordController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/v1/customers/{id}', [CustomerRecordController::class, 'destroy'])->middleware('auth:sanctum');
Route::delete('/v1/customers/{id}/permanently', [CustomerRecordController::class, 'permanentlyDelete'])->middleware('auth:sanctum');
Route::get('/v1/customers/{id}/restore', [CustomerRecordController::class, 'restore'])->middleware('auth:sanctum');

Route::get('/v1/medication', [MedicationInventory::class, 'index'])->middleware('auth:sanctum');
Route::post('/v1/medication', [MedicationInventory::class, 'store'])->middleware('auth:sanctum');
Route::get('/v1/medication/{id}', [MedicationInventory::class, 'show'])->middleware('auth:sanctum');
Route::put('/v1/medication/{id}', [MedicationInventory::class, 'update'])->middleware('auth:sanctum');
Route::delete('/v1/medication/{id}', [MedicationInventory::class, 'destroy'])->middleware('auth:sanctum');
Route::delete('/v1/medication/{id}/permanently', [MedicationInventory::class, 'permanentlyDelete'])->middleware('auth:sanctum');
Route::get('/v1/medication/{id}/restore', [MedicationInventory::class, 'restore'])->middleware('auth:sanctum');