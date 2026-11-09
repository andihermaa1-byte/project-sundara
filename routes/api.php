<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\DeviceController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes - SUNDARA Ecosystem
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    // Endpoint SSO Google untuk Flutter Mobile
    Route::post('/google/mobile', function (Request $request) {
        $request->validate([
            'token' => 'required|string',
        ]);

        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver('google');
            $googleUser = $driver->stateless()->userFromToken($request->token);

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Guru Sundara',
                'password' => bcrypt(Str::random(16)),
            ]);

            // Terbitkan Token Sanctum khusus mobile
            $token = $user->createToken('auth_token_mobile')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Google Token: ' . $e->getMessage()
            ], 401);
        }
    });

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