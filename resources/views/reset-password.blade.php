<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - SUNDARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sundanese:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-sundanese { font-family: 'Noto Sans Sundanese', sans-serif; }
        .bg-pattern-cream {
            background-color: #FAF8F5;
            background-image: radial-gradient(#E5DFD5 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row antialiased text-slate-800">

    <!-- PANEL KIRI: Branding -->
    <div class="lg:w-[42%] bg-[#182B49] text-white p-8 sm:p-12 lg:p-14 flex flex-col justify-between relative overflow-hidden">
        <svg class="absolute inset-0 w-full h-full opacity-10 pointer-events-none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-50 220 Q 150 180, 350 260 T 750 240" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-dasharray="4 4"/>
            <path d="M-50 420 Q 200 380, 400 460 T 800 430" fill="none" stroke="#94A3B8" stroke-width="1.5" stroke-dasharray="4 4"/>
            <circle cx="75%" cy="22%" r="38" fill="none" stroke="#94A3B8" stroke-width="1"/>
        </svg>

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

        <div class="relative z-10 my-12 lg:my-0">
            <div class="flex items-center gap-2 mb-6">
                <span class="w-8 h-[2px] bg-[#EAB308] rounded-full"></span>
                <svg class="w-3.5 h-3.5 text-[#EAB308]" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
                </svg>
                <span class="w-14 h-[1px] bg-slate-500/50"></span>
            </div>

            <h2 class="text-3xl sm:text-4xl font-bold leading-tight text-white">
                Buat Kata Sandi<br>Baru yang Aman
            </h2>

            <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-md">
                Gunakan kombinasi huruf kapital, huruf kecil, dan angka atau simbol untuk melindungi data kelas dan evaluasi siswa Anda.
            </p>
        </div>

        <div class="relative z-10 pt-6 border-t border-white/10 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-300">
            <span>Portal Khusus Guru • SMP/SMA</span>
            <div class="flex items-center gap-2 font-medium text-slate-200">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>End-to-End Encrypted</span>
            </div>
        </div>
    </div>

    <!-- PANEL KANAN: Form Reset Password -->
    <div class="lg:w-[58%] bg-pattern-cream flex items-center justify-center p-6 sm:p-10">
        <div class="w-full max-w-[440px] bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 sm:p-10">
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EEF2FF] text-[#3B5BDB] text-xs font-semibold mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>Keamanan Akun</span>
            </div>

            <h2 class="text-2xl font-bold text-slate-900">Atur Ulang Kata Sandi</h2>
            <p class="mt-1.5 text-sm text-slate-500">
                Silakan masukkan kata sandi baru untuk akun pengajar Anda.
            </p>

            <div id="error-alert" class="hidden mt-4 p-3 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700"></div>

            <form id="reset-form" class="mt-6 space-y-4" novalidate>
                <input type="hidden" id="token" value="{{ $token }}">

                <!-- Email (Readonly dari parameter URL) -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email Pengajar</label>
                    <input type="email" id="email" value="{{ $email }}" required
                        class="w-full px-3.5 py-2.5 text-sm text-slate-600 bg-slate-50 border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:outline-none">
                </div>

                <!-- Kata Sandi Baru -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" id="password" required placeholder="Masukkan kata sandi baru"
                            class="w-full pl-3.5 pr-10 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                        <button type="button" data-target="password" class="toggle-pwd absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Indikator Syarat Kata Sandi -->
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
                </div>

                <!-- Konfirmasi Kata Sandi Baru -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" required placeholder="Ulangi kata sandi baru"
                            class="w-full pl-3.5 pr-10 py-2.5 text-sm text-slate-800 bg-white border border-slate-200 rounded-xl focus:border-[#1E3A5F] focus:ring-2 focus:ring-[#1E3A5F]/15 focus:outline-none transition">
                        <button type="button" data-target="password_confirmation" class="toggle-pwd absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" id="btn-submit"
                    class="w-full py-3 px-4 mt-2 flex items-center justify-center gap-2 text-sm font-semibold text-white bg-[#1D3557] hover:bg-[#152742] rounded-xl shadow-sm transition duration-200 cursor-pointer">
                    <span id="btn-text">Simpan Kata Sandi Baru</span>
                    <svg id="btn-arrow" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <x-loading-overlay />

    <script>
        document.querySelectorAll('.toggle-pwd').forEach(btn => {
            btn.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                target.type = target.type === 'password' ? 'text' : 'password';
            });
        });

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

        document.getElementById('reset-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const btnSubmit = document.getElementById('btn-submit');
            const btnText = document.getElementById('btn-text');
            const btnArrow = document.getElementById('btn-arrow');
            const errorBox = document.getElementById('error-alert');

            errorBox.classList.add('hidden');
            btnSubmit.disabled = true;
            btnText.innerText = 'Menyimpan...';
            btnArrow.classList.add('hidden');

            const payload = {
                token: document.getElementById('token').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
            };

            try {
                const response = await fetch('/api/auth/reset-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    showSundaraTransition('Kata sandi diperbarui! Mengalihkan ke halaman Masuk...', '/login', 900);
                } else {
                    const firstError = data.errors ? Object.values(data.errors)[0][0] : (data.message || 'Gagal mengatur ulang kata sandi.');
                    errorBox.innerText = firstError;
                    errorBox.classList.remove('hidden');
                }
            } catch (err) {
                errorBox.innerText = 'Gagal terhubung ke server API backend.';
                errorBox.classList.remove('hidden');
            } finally {
                btnSubmit.disabled = false;
                btnText.innerText = 'Simpan Kata Sandi Baru';
                btnArrow.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>