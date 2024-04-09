<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::post('/v1/auth/login',[UserAuthController::class, 'login']);
Route::get('/v1/auth/users',[UserAuthController::class, 'index'])->middleware('auth:sanctum');
Route::post('/v1/auth/logout',[UserAuthController::class, 'logout'])->middleware('auth:sanctum');

// All records
Route::middleware('auth:sanctum')->get('/v1/medication', [MedicationInventoryController::class, 'index']);
Route::middleware('auth:sanctum')->get('/v1/customers', [CustomerRecordController::class, 'index']);
//Individual records
Route::middleware('auth:sanctum')->get('/v1/medication/{id}', [MedicationInventoryController::class, 'show']);
Route::middleware('auth:sanctum')->get('/v1/customers/{id}', [MedicationInventoryController::class, 'show']);


Route::middleware(['auth:sanctum','role:Owner'])->group(function () {
    Route::post('/v1/customers', [CustomerRecordController::class, 'store']);
    Route::delete('/v1/customers/{id}/permanently', [CustomerRecordController::class, 'permanentlyDelete']);
    Route::get('/v1/customers/{id}/restore', [CustomerRecordController::class, 'restore']);

    Route::post('/v1/medication', [MedicationInventoryController::class, 'store']);
    Route::delete('/v1/medication/{id}/permanently', [MedicationInventoryController::class, 'permanentlyDelete']);
    Route::get('/v1/customers/{id}/restore', [CustomerRecordController::class, 'restore']);
    Route::get('/v1/medication/{id}/restore', [MedicationInventoryController::class, 'restore']);
});

Route::middleware(['auth:sanctum','role:Owner|Manager'])->group(function () {
    Route::delete('/v1/customers/{id}', [CustomerRecordController::class, 'softDelete']);
    Route::delete('/v1/medication/{id}', [MedicationInventoryController::class, 'softDelete']);
});

Route::middleware(['auth:sanctum','role:Cashier|Owner|Manager'])->group(function () {
    Route::put('/v1/customers/{id}', [CustomerRecordController::class, 'update']);
    Route::put('/v1/medication/{id}', [MedicationInventoryController::class, 'update']);
});