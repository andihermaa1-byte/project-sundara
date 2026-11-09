<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\DeviceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        // Data Kelas & Siswa
        Route::apiResource('classes', ClassController::class);
        Route::apiResource('students', StudentController::class);

        // Kontrol Sesi Pembelajaran Guru (FR-06 & FR-07)
        Route::get('/sessions/current', [SessionController::class, 'currentSession']);
        Route::post('/sessions/start', [SessionController::class, 'startSession']);
        Route::post('/sessions/end/{id}', [SessionController::class, 'endSession']);
    });
});

// Endpoint Publik/Perangkat IoT ESP32 (FR-10)
Route::post('/device/scan', [DeviceController::class, 'handleScan']);