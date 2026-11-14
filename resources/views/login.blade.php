<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Akun Guru - SUNDARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Plus Jakarta Sans & Noto Sans Sundanese agar tampilan aksara & tipografi presisi -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sundanese:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-sundanese {
            font-family: 'Noto Sans Sundanese', sans-serif;
        }
        /* Pola latar belakang halus pada sisi kanan */
        .bg-pattern-cream {
            background-color: #FAF8F5;
            background-image: radial-gradient(#E5DFD5 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row antialiased text-slate-800">

    <!-- PANEL KIRI: Branding & Informasi Sistem -->
    <div class="lg:w-[42%] bg-[#182B49] text-white p-8 sm:p-12 lg:p-14 flex flex-col justify-between relative overflow-hidden">
        <!-- Ornamen Garis Gelombang & Atom Halus di Latar Belakang -->
        <svg class="absolute inset-0 w-full h-full opacity-10 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-50 220 Q 150 180, 350 260 T 750 240" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-dasharray="4 4"/>
            <path d="M-50 420 Q 200 380, 400 460 T 800 430" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-dasharray="4 4"/>
            <circle cx="75%" cy="22%" r="38" fill="none" stroke="#94A3B8" stroke-width="1"/>
            <ellipse cx="75%" cy="22%" rx="55" ry="18" transform="rotate(30 300 180)" fill="none" stroke="#94A3B8" stroke-width="1"/>
            <ellipse cx="75%" cy="22%" rx="55" ry="18" transform="rotate(-30 300 180)" fill="none" stroke="#94A3B8" stroke-width="1"/>
        </svg>

        <!-- Header Logo SUNDARA -->
        <div class="relative z-10 flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-[#243B61] border border-white/10 flex items-center justify-center shadow-inner">
                <span class="font-sundanese text-xl font-bold text-[#F59E0B]">ᮞ</span>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-wide text-white leading-none">SUNDARA</h1>
                <p class="text-[11px] font-semibold tracking-wider text-[#EAB308] uppercase mt-1">
                    Sistem Pembelajaran Aksara Sunda
                </p>
            </div>
        </div>

        <!-- Konten Utama Kiri -->
        <div class="relative z-10 my-12 lg:my-0">
            <!-- Garis Aksen Emas & Bintang -->
            <div class="flex items-center gap-2 mb-6">
                <span class="w-8 h-[2px] bg-[#EAB308] rounded-full"></span>
                <svg class="w-3.5 h-3.5 text-[#EAB308]" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
                </svg>
                <span class="w-14 h-[1px] bg-slate-500/50"></span>
            </div>

            <h2 class="text-3xl sm:text-4xl font-bold leading-tight text-white">
                Belajar Aksara Sunda<br>lebih interaktif
            </h2>

            <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-md">
                Platform terpadu evaluasi berbasis RFID Smart Board untuk memudahkan guru mengelola kelas, bank soal, dan menganalisis capaian siswa.
            </p>

            <!-- Badge Aksara Sunda Tradisional -->
            <div class="mt-8 inline-flex items-center gap-3.5 px-4 py-3 rounded-xl bg-[#22385C]/90 border border-white/10 backdrop-blur-sm">
                <span class="font-sundanese text-lg font-bold text-[#F59E0B] tracking-widest">ᮞᮥᮔ᮪ᮓᮛ</span>
                <span class="h-4 w-[1px] bg-slate-500/50"></span>
                <span class="text-xs font-medium text-slate-200">
                    Aksara Sunda Tradisional • U+1B80–U+1BBF
                </span>
            </div>
        </div>

        <!-- Footer Panel Kiri -->
        <div class="relative z-10 pt-6 border-t border-white/10 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-300">
            <span>Portal Khusus Guru • SMP/SMA</span>
            <div class="flex items-center gap-2 font-medium text-slate-200">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>RFID Board Sync Ready</span>
            </div>
        </div>
    </div>

    <!-- PANEL KANAN: Form Login Guru -->
    <div class="lg:w-[58%] bg-pattern-cream flex items-center justify-center p-6 sm:p-10">
        <div class="w-full max-w-[440px] bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 sm:p-10">
            
            <!-- Pill Badge Autentikasi Guru -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EEF2FF] text-[#3B5BDB] text-xs font-semibold mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>Autentikasi Guru</span>
            </div>

            <h2 class="text-2xl font-bold text-slate-900">Masuk ke Akun Guru</h2>
            <p class="mt-1.5 text-sm text-slate-500 leading-relaxed">
                Gunakan kredensial pengajar Anda untuk mengelola sesi belajar.
            </p>

            <!-- Form Login -->
            <form id="login-form" class="mt-7 space-y-5" novalidate>
                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" id="email" required placeholder="guru.sundara@sekolah.sch.id"
                            class="w-full pl-11 pr-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                    </div>
                </div>

                <!-- Input Kata Sandi -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                        <a href="/forgot-password" class="text-xs font-semibold text-[#1E3A5F] hover:underline">
                            Lupa kata sandi?
                        </a>
                    </div>
                    <div class="relative">
                        <div id="password-icon" class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" id="password" required placeholder="••••••••"
                            class="w-full pl-11 pr-11 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                        
                        <!-- Tombol Toggle Show/Hide Password -->
                        <button type="button" id="toggle-password" aria-label="Tampilkan kata sandi"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Pesan Error Inline (Sesuai Mockup) -->
                    <div id="error-alert" class="hidden mt-2 flex items-start gap-1.5 text-xs text-red-600" role="alert">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="error-message">Kata sandi tidak sesuai. Silakan periksa kembali huruf besar dan kecil.</span>
                    </div>
                </div>

                <!-- Tombol Submit Utama -->
                <button type="submit" id="btn-submit"
                    class="w-full py-3 px-4 flex items-center justify-center gap-2 text-sm font-semibold text-white bg-[#1D3557] hover:bg-[#152742] rounded-xl shadow-sm transition duration-200 cursor-pointer">
                    <span id="btn-text">Masuk</span>
                    <svg id="btn-arrow" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Pembatas ATAU -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-[11px] font-semibold tracking-wider uppercase">
                    <span class="bg-white px-3 text-slate-400">ATAU</span>
                </div>
            </div>

            <!-- Tombol Google SSO -->
            <a href="/auth/google/redirect"
               class="w-full flex items-center justify-center gap-2.5 py-2.5 px-4 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Masuk dengan Google</span>
            </a>

            <!-- Link Daftar Akun -->
            <p class="mt-7 text-center text-xs text-slate-500">
                Belum punya akun? <a href="/register" class="font-bold text-[#1D3557] hover:underline">Daftar</a>
            </p>
        </div>
    </div>

    <!-- Komponen Loading Overlay SUNDARA -->
    <x-loading-overlay />

    <script>
        // Toggle Tampilkan / Sembunyikan Kata Sandi
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeIcon.innerHTML = isPassword
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        });

        // Helper untuk menampilkan & mereset state error pada input password
        const passwordIcon = document.getElementById('password-icon');
        const alertBox = document.getElementById('error-alert');
        const alertMsg = document.getElementById('error-message');

        function setPasswordError(message) {
            alertMsg.innerText = message;
            alertBox.classList.remove('hidden');
            passwordInput.classList.remove('border-slate-200', 'focus:border-[#1E3A5F]', 'focus:ring-[#1E3A5F]/15');
            passwordInput.classList.add('border-red-400', 'focus:border-red-500', 'focus:ring-red-500/15');
            passwordIcon.classList.remove('text-slate-400');
            passwordIcon.classList.add('text-red-500');
        }

        function clearPasswordError() {
            alertBox.classList.add('hidden');
            passwordInput.classList.add('border-slate-200', 'focus:border-[#1E3A5F]', 'focus:ring-[#1E3A5F]/15');
            passwordInput.classList.remove('border-red-400', 'focus:border-red-500', 'focus:ring-red-500/15');
            passwordIcon.classList.add('text-slate-400');
            passwordIcon.classList.remove('text-red-500');
        }

        passwordInput.addEventListener('input', clearPasswordError);

        // Proses Submit Login ke REST API Laravel
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btnSubmit = document.getElementById('btn-submit');
            const btnText = document.getElementById('btn-text');
            const btnArrow = document.getElementById('btn-arrow');

            btnSubmit.disabled = true;
            btnText.innerText = 'Memproses...';
            btnArrow.classList.add('hidden');
            clearPasswordError();

            const email = document.getElementById('email').value;
            const password = passwordInput.value;

            try {
                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    localStorage.setItem('sso_token', data.data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.data.user));
                    
                    // Munculkan loading logo SUNDARA dulu selama 1.3 detik sebelum ke dashboard
                    showSundaraTransition('Autentikasi berhasil, menyiapkan Dashboard Guru...', '/dashboard', 700);
                } else {
                    const errorMessage = data.message || (data.errors?.email ? data.errors.email[0] : 'Kata sandi tidak sesuai. Silakan periksa kembali huruf besar dan kecil.');
                    setPasswordError(errorMessage);
                }
            } catch (err) {
                setPasswordError('Gagal terhubung ke server API backend.');
            } finally {
                btnSubmit.disabled = false;
                btnText.innerText = 'Masuk';
                btnArrow.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>