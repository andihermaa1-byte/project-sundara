<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Guru - SUNDARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        .bg-pattern-cream {
            background-color: #FAF8F5;
            background-image: radial-gradient(#E5DFD5 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row antialiased text-slate-800">

    <!-- PANEL KIRI: Branding & Keunggulan Sistem -->
    <div class="lg:w-[42%] bg-[#182B49] text-white p-8 sm:p-12 lg:p-14 flex flex-col justify-between relative overflow-hidden">
        <svg class="absolute inset-0 w-full h-full opacity-10 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-50 220 Q 150 180, 350 260 T 750 240" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-dasharray="4 4"/>
            <path d="M-50 420 Q 200 380, 400 460 T 800 430" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-dasharray="4 4"/>
            <circle cx="75%" cy="22%" r="38" fill="none" stroke="#94A3B8" stroke-width="1"/>
        </svg>

        <!-- Header Logo & Badge Aksara -->
        <div class="relative z-10">
            <div class="flex items-center gap-3.5">
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

            <!-- Badge Aksara Sunda Tradisional -->
            <div class="mt-6 inline-flex items-center gap-3 px-3.5 py-2 rounded-xl bg-[#22385C]/90 border border-white/10">
                <span class="font-sundanese text-base font-bold text-[#F59E0B] tracking-widest">ᮞᮥᮔ᮪ᮓᮛ</span>
                <span class="h-3.5 w-[1px] bg-slate-500/50"></span>
                <span class="text-[11px] font-medium text-slate-200">
                    Aksara Sunda Tradisional • U+1B80–U+1BBF
                </span>
            </div>
        </div>

        <!-- Konten Utama Kiri -->
        <div class="relative z-10 my-10 lg:my-0">
            <h2 class="text-3xl sm:text-4xl font-bold leading-tight text-white">
                Belajar Aksara Sunda<br>lebih interaktif
            </h2>

            <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-md">
                Platform terpadu evaluasi berbasis RFID Smart Board untuk memudahkan guru mengelola kelas, bank soal, dan menganalisis capaian siswa.
            </p>

            <!-- Daftar Fitur Utama (Sesuai Gambar 7 SRS) -->
            <ul class="mt-7 space-y-3.5 text-sm text-slate-200">
                <li class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-md bg-[#EAB308]/20 text-[#F59E0B] flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span>Observasi interaksi papan cerdas RFID waktu-nyata</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-md bg-[#EAB308]/20 text-[#F59E0B] flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span>Validasi ortografis Swara, Ngalagena & Rarangkén</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="w-5 h-5 rounded-md bg-[#EAB308]/20 text-[#F59E0B] flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span>Matriks diagnosis capaian kompetensi instruksional</span>
                </li>
            </ul>
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

    <!-- PANEL KANAN: Form Pendaftaran Akun Guru -->
    <div class="lg:w-[58%] bg-pattern-cream flex flex-col items-center justify-center p-6 sm:p-10">
        <div class="w-full max-w-[460px] bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-7 sm:p-9">
            
            <!-- Pill Badge -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EEF2FF] text-[#3B5BDB] text-[11px] font-bold tracking-wide uppercase mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span>Pendaftaran Akun Guru</span>
            </div>

            <h2 class="text-2xl font-bold text-slate-900">Daftar Akun Guru</h2>
            <p class="mt-1 text-sm text-slate-500">
                Lengkapi data pengajar Anda untuk mulai menggunakan sistem SUNDARA.
            </p>

            <!-- Alert Error Global -->
            <div id="global-error" class="hidden mt-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700"></div>

            <!-- Form Registrasi -->
            <form id="register-form" class="mt-5 space-y-4" novalidate>
                <!-- Nama Lengkap & Gelar -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">
                        Nama Lengkap & Gelar <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" id="name" required placeholder="Drs. Ahmad Fauzi, M.Pd."
                            class="w-full pl-10 pr-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                    </div>
                    <p id="err-name" class="hidden mt-1 text-xs text-red-600"></p>
                </div>

                <!-- Alamat Email Pengajar -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                        Alamat Email Pengajar <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" id="email" required placeholder="guru.sundara@sekolah.sch.id"
                            class="w-full pl-10 pr-4 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                    </div>
                    <p id="err-email" class="hidden mt-1 text-xs text-red-600"></p>
                </div>

                <!-- Kata Sandi -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">
                        Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" id="password" required placeholder="Buat kata sandi aman"
                            class="w-full pl-10 pr-10 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                        <button type="button" data-target="password" class="toggle-pwd absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Kotak Indikator Syarat Kata Sandi (Sesuai Gambar 7 SRS) -->
                    <div class="mt-2 p-3 rounded-xl bg-[#FAF8F5] border border-slate-200/70 space-y-1.5 text-xs text-slate-500">
                        <div id="rule-length" class="flex items-center gap-2 transition-colors">
                            <span class="rule-dot w-3.5 h-3.5 rounded-full border border-slate-300 flex items-center justify-center text-[9px]"></span>
                            <span>Minimal 8 karakter</span>
                        </div>
                        <div id="rule-case" class="flex items-center gap-2 transition-colors">
                            <span class="rule-dot w-3.5 h-3.5 rounded-full border border-slate-300 flex items-center justify-center text-[9px]"></span>
                            <span>Kombinasi huruf besar & kecil</span>
                        </div>
                        <div id="rule-num" class="flex items-center gap-2 transition-colors">
                            <span class="rule-dot w-3.5 h-3.5 rounded-full border border-slate-300 flex items-center justify-center text-[9px]"></span>
                            <span>Minimal 1 angka atau simbol</span>
                        </div>
                    </div>
                    <p id="err-password" class="hidden mt-1 text-xs text-red-600"></p>
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1">
                        Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input type="password" id="password_confirmation" required placeholder="Ulangi kata sandi"
                            class="w-full pl-10 pr-10 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                        <button type="button" data-target="password_confirmation" class="toggle-pwd absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <p id="err-password_confirmation" class="hidden mt-1 text-xs text-red-600"></p>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" id="btn-submit"
                    class="w-full py-3 px-4 mt-2 flex items-center justify-center gap-2 text-sm font-semibold text-white bg-[#1D3557] hover:bg-[#152742] rounded-xl shadow-sm transition duration-200 cursor-pointer">
                    <span id="btn-text">Daftar</span>
                    <svg id="btn-arrow" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Pembatas ATAU -->
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-[11px] font-semibold tracking-wider uppercase">
                    <span class="bg-white px-3 text-slate-400">atau</span>
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
                <span>Daftar dengan Google</span>
            </a>

            <!-- Link Masuk -->
            <p class="mt-6 text-center text-xs text-slate-500">
                Sudah punya akun? <a href="/login" class="font-bold text-[#1D3557] hover:underline">Masuk</a>
            </p>
        </div>

        <p class="mt-5 text-center text-[11px] text-slate-400 max-w-md">
            Dilindungi oleh enkripsi standar instansi pendidikan. Dengan mendaftar, Anda menyetujui Pedoman Tata Kelola Data Kurikulum Sundara.
        </p>
    </div>

   <!-- Komponen Loading Overlay SUNDARA -->
    <x-loading-overlay />

    <script>
        // Toggle Show/Hide Password untuk kedua input
        document.querySelectorAll('.toggle-pwd').forEach(btn => {
            btn.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                target.type = target.type === 'password' ? 'text' : 'password';
            });
        });

        // Live Validation Indikator Syarat Kata Sandi
        const pwdInput = document.getElementById('password');
        function updateRule(elementId, isValid) {
            const el = document.getElementById(elementId);
            const dot = el.querySelector('.rule-dot');
            if (isValid) {
                el.classList.remove('text-slate-500');
                el.classList.add('text-emerald-700', 'font-medium');
                dot.classList.remove('border-slate-300');
                dot.classList.add('bg-emerald-600', 'border-emerald-600', 'text-white');
                dot.innerHTML = '✓';
            } else {
                el.classList.add('text-slate-500');
                el.classList.remove('text-emerald-700', 'font-medium');
                dot.classList.add('border-slate-300');
                dot.classList.remove('bg-emerald-600', 'border-emerald-600', 'text-white');
                dot.innerHTML = '';
            }
        }

        pwdInput.addEventListener('input', function () {
            const val = this.value;
            updateRule('rule-length', val.length >= 8);
            updateRule('rule-case', /[a-z]/.test(val) && /[A-Z]/.test(val));
            updateRule('rule-num', /[0-9!@#$%^&*(),.?":{}|<>]/.test(val));
        });

        // Helper tampilkan error per field
        function clearErrors() {
            document.getElementById('global-error').classList.add('hidden');
            ['name', 'email', 'password', 'password_confirmation'].forEach(field => {
                const errEl = document.getElementById('err-' + field);
                const inputEl = document.getElementById(field);
                errEl.classList.add('hidden');
                inputEl.classList.remove('border-red-400');
            });
        }

        // Submit Form Registrasi ke REST API
        document.getElementById('register-form').addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();

            const btnSubmit = document.getElementById('btn-submit');
            const btnText = document.getElementById('btn-text');
            const btnArrow = document.getElementById('btn-arrow');

            btnSubmit.disabled = true;
            btnText.innerText = 'Mendaftarkan...';
            btnArrow.classList.add('hidden');

            const payload = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
            };

            try {
                const response = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    localStorage.setItem('sso_token', data.data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.data.user));
                    
                    // Munculkan loading logo SUNDARA dulu selama 1.3 detik sebelum ke dashboard
                    showSundaraTransition('Akun berhasil dibuat, menyiapkan Dashboard Guru...', '/dashboard', 700);
                } else if (response.status === 422 && data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const errEl = document.getElementById('err-' + field);
                        const inputEl = document.getElementById(field);
                        if (errEl && inputEl) {
                            errEl.innerText = data.errors[field][0];
                            errEl.classList.remove('hidden');
                            inputEl.classList.add('border-red-400');
                        }
                    });
                } else {
                    const globalErr = document.getElementById('global-error');
                    globalErr.innerText = data.message || 'Pendaftaran gagal. Silakan coba lagi.';
                    globalErr.classList.remove('hidden');
                }
            } catch (err) {
                const globalErr = document.getElementById('global-error');
                globalErr.innerText = 'Gagal terhubung ke server API backend.';
                globalErr.classList.remove('hidden');
            } finally {
                btnSubmit.disabled = false;
                btnText.innerText = 'Daftar';
                btnArrow.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>