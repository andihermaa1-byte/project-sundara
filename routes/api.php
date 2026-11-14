<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ClassStudentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Api\RfidCardController;



/*
|--------------------------------------------------------------------------
| API Routes - SUNDARA Ecosystem
|--------------------------------------------------------------------------
*/

// 1. Grup Autentikasi (Prefix: /api/auth/...)
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']); 

    // Endpoint SSO Google Mobile / Web Client
    Route::post('/google/mobile', function (Request $request) {
        $request->validate(['token' => 'required|string']);

        $token = $request->token;
        $email = null;
        $name = null;

        try {
            $driver = Socialite::driver('google');
            $googleUser = $driver->stateless()->userFromToken($token);
            $email = $googleUser->getEmail();
            $name = $googleUser->getName() ?? $googleUser->getNickname();
        } catch (\Exception $e) {
            try {
                $response = Http::get('https://oauth2.googleapis.com/tokeninfo', ['id_token' => $token]);
                if ($response->failed()) {
                    $response = Http::get('https://oauth2.googleapis.com/tokeninfo', ['access_token' => $token]);
                }
                if ($response->successful()) {
                    $userData = $response->json();
                    $email = $userData['email'] ?? null;
                    $name = $userData['name'] ?? null;
                }
            } catch (\Exception $ex) {}
        }

        if ($email) {
            $user = User::updateOrCreate([
                'email' => $email,
            ], [
                'name' => $name ?? 'Guru Sundara',
                'password' => bcrypt(Str::random(16)),
            ]);

            $sanctumToken = $user->createToken('auth_token_mobile')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'token' => $sanctumToken,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Token Google tidak valid atau telah kedaluwarsa.'
        ], 401);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// 2. Rute Utama Terproteksi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Dashboard & Statistik Utama
    Route::get('/dashboard/summary', [DashboardController::class, 'summary']);

    // Manajemen Kelas & Siswa
    Route::get('/classes', [ClassStudentController::class, 'indexClasses']);
    Route::post('/classes', [ClassStudentController::class, 'storeClass']);
    Route::delete('/classes/{id}', [ClassStudentController::class, 'destroyClass']);

    Route::get('/students', [ClassStudentController::class, 'indexStudents']);
    Route::post('/students', [ClassStudentController::class, 'storeStudent']);
    Route::put('/students/{id}', [ClassStudentController::class, 'updateStudent']);
    Route::delete('/students/{id}', [ClassStudentController::class, 'destroyStudent']);

    // Bank Soal & Kategori
    Route::get('/categories', [QuestionController::class, 'indexCategories']);
    Route::apiResource('questions', QuestionController::class);

    // Kontrol Sesi Pembelajaran Guru
    Route::get('/sessions/current', [SessionController::class, 'currentSession']);
    Route::post('/sessions/start', [SessionController::class, 'startSession']);
    Route::post('/sessions/end/{id}', [SessionController::class, 'endSession']);
    // Tambahkan di dalam kelompok Route::middleware('auth:sanctum')->group(function () { ... });
    Route::apiResource('rfid-cards', RfidCardController::class);
});

// 3. Endpoint Publik / Perangkat IoT ESP32
Route::post('/device/scan', [DeviceController::class, 'handleScan']);