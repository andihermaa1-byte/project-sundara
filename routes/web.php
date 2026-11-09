<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes - SUNDARA Ecosystem
|--------------------------------------------------------------------------
*/

// Redirect halaman utama ke Login
Route::get('/', function () {
    return redirect('/login');
});

// Halaman View Login Guru
Route::get('/login', function () {
    return view('login');
});

// Halaman View Dashboard Guru
Route::get('/dashboard', function () {
    return view('dashboard');
});

// --------------------------------------------------------------------------
// SSO Google Routes (Laravel Socialite)
// --------------------------------------------------------------------------

// 1. Redirect Guru ke Halaman Otentikasi Google
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});

// 2. Callback Menerima Data Respon dari Google
Route::get('/api/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->user();

        // Cari user berdasarkan email Google, atau buat akun baru jika belum terdaftar
        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'password' => bcrypt(Str::random(16)), // Password acak aman untuk SSO
        ]);

        // Terbitkan Token Sanctum SSO untuk akses API
        $token = $user->createToken('auth_token')->plainTextToken;

        // Redirect ke Dashboard dengan membawa token & nama user
        return redirect("/dashboard?token=" . $token . "&name=" . urlencode($user->name));
    } catch (\Exception $e) {
        return redirect('/login?error=sso_failed');
    }
});