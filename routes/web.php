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

// Halaman View Dashboard Guru (ditambahkan Header No-Cache)
Route::get('/dashboard', function () {
    return response()
        ->view('dashboard')
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
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

        // Cari user berdasarkan email Google, atau buat akun baru jika belum ada
        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Guru Sundara',
            'password' => bcrypt(Str::random(16)),
        ]);

        // Terbitkan Token Sanctum SSO
        $token = $user->createToken('auth_token')->plainTextToken;

        // Redirect ke Dashboard dengan membawa token & nama user
        return redirect("/dashboard?token=" . $token . "&name=" . urlencode($user->name));
    } catch (\Exception $e) {
        // Tampilkan pesan error detail jika terjadi masalah saat pemrosesan user/database
        dd('SSO Callback Error: ' . $e->getMessage());
    }
});
