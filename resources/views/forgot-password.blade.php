<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SUNDARA</title>
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
                Pemulihan Akses<br>Portal Pengajar
            </h2>

            <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-md">
                Kami akan mengirimkan tautan verifikasi aman ke alamat email pengajar Anda untuk mengatur ulang kata sandi.
            </p>
        </div>

        <div class="relative z-10 pt-6 border-t border-white/10 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-300">
            <span>Portal Khusus Guru • SMP/SMA</span>
            <div class="flex items-center gap-2 font-medium text-slate-200">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Security Recovery Ready</span>
            </div>
        </div>
    </div>

    <!-- PANEL KANAN: Form Lupa Kata Sandi -->
    <div class="lg:w-[58%] bg-pattern-cream flex items-center justify-center p-6 sm:p-10">
        <div class="w-full max-w-[440px] bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 p-8 sm:p-10">
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EEF2FF] text-[#3B5BDB] text-xs font-semibold mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                <span>Pemulihan Akun</span>
            </div>

            <h2 class="text-2xl font-bold text-slate-900">Lupa Kata Sandi?</h2>
            <p class="mt-1.5 text-sm text-slate-500 leading-relaxed">
                Masukkan alamat email pengajar yang terdaftar. Kami akan mengirimkan tautan untuk membuat kata sandi baru.
            </p>

            <!-- Alert Sukses -->
            <div id="success-alert" class="hidden mt-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 leading-relaxed"></div>

            <!-- Alert Error -->
            <div id="error-alert" class="hidden mt-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700 leading-relaxed"></div>

            <form id="forgot-form" class="mt-6 space-y-5" novalidate>
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email Pengajar</label>
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

                <button type="submit" id="btn-submit"
                    class="w-full py-3 px-4 flex items-center justify-center gap-2 text-sm font-semibold text-white bg-[#1D3557] hover:bg-[#152742] rounded-xl shadow-sm transition duration-200 cursor-pointer">
                    <span id="btn-text">Kirim Tautan Atur Ulang</span>
                    <svg id="btn-arrow" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <div class="mt-7 pt-5 border-t border-slate-100 text-center">
                <a href="/login" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1D3557] hover:underline">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali ke halaman Masuk</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('forgot-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const btnSubmit = document.getElementById('btn-submit');
            const btnText = document.getElementById('btn-text');
            const btnArrow = document.getElementById('btn-arrow');
            const successBox = document.getElementById('success-alert');
            const errorBox = document.getElementById('error-alert');

            successBox.classList.add('hidden');
            errorBox.classList.add('hidden');
            btnSubmit.disabled = true;
            btnText.innerText = 'Mengirim tautan...';
            btnArrow.classList.add('hidden');

            const email = document.getElementById('email').value;

            try {
                const response = await fetch('/api/auth/forgot-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    successBox.innerText = data.message;
                    successBox.classList.remove('hidden');
                    document.getElementById('forgot-form').reset();
                } else {
                    errorBox.innerText = data.errors?.email ? data.errors.email[0] : (data.message || 'Gagal mengirim tautan.');
                    errorBox.classList.remove('hidden');
                }
            } catch (err) {
                errorBox.innerText = 'Gagal terhubung ke server API backend.';
                errorBox.classList.remove('hidden');
            } finally {
                btnSubmit.disabled = false;
                btnText.innerText = 'Kirim Tautan Atur Ulang';
                btnArrow.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>