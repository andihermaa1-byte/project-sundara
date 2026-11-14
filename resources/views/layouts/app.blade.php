<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Guru') - SUNDARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sundanese:wght@500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
        .font-sundanese {
            font-family: 'Noto Sans Sundanese', sans-serif;
        }
        /* Scrollbar halus untuk sidebar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
    </style>
    @stack('styles')
</head>
<body class="text-slate-800 antialiased min-h-screen flex bg-[#F8FAFC]">

    <!-- Backdrop Mobile Sidebar -->
    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-xs hidden lg:hidden"></div>

    <!-- SIDEBAR NAVIGASI PERMANEN -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-[260px] bg-white border-r border-slate-200/80 flex flex-col justify-between transition-transform duration-200 -translate-x-full lg:translate-x-0">
        
        <!-- Bagian Atas: Logo & Menu Utama -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <!-- Header Logo SUNDARA -->
            <div class="px-6 pt-6 pb-5 flex items-center justify-between">
                <a href="/dashboard" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-[#182B49] flex items-center justify-center shadow-sm">
                        <span class="font-sundanese text-lg font-bold text-[#F59E0B]">ᮞ</span>
                    </div>
                    <div>
                        <h1 class="text-base font-bold tracking-wide text-[#182B49] leading-none">SUNDARA</h1>
                        <p class="text-[10px] font-semibold tracking-wider text-slate-400 uppercase mt-1">
                            Portal Guru
                        </p>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Daftar 8 Menu Navigasi -->
            <nav class="px-3.5 space-y-1 mt-1">
                @php
                    $menus = [
                        [
                            'label' => 'Dashboard',
                            'url'   => '/dashboard',
                            'active'=> request()->is('dashboard'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>'
                        ],
                        [
                            'label' => 'Kelas',
                            'url'   => '/kelas',
                            'active'=> request()->is('kelas*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>'
                        ],
                        [
                            'label' => 'Siswa',
                            'url'   => '/siswa',
                            'active'=> request()->is('siswa*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'
                        ],
                        [
                            'label' => 'Kartu RFID',
                            'url'   => '/rfid-cards',
                            'active'=> request()->is('rfid-cards*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>'
                        ],
                        [
                            'label' => 'Bank Soal',
                            'url'   => '/bank-soal',
                            'active'=> request()->is('bank-soal*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                        ],
                        [
                            'label' => 'Sesi Pembelajaran',
                            'url'   => '/sesi-pembelajaran',
                            'active'=> request()->is('sesi-pembelajaran*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>'
                        ],
                        [
                            'label' => 'Hasil Pembelajaran',
                            'url'   => '/hasil-pembelajaran',
                            'active'=> request()->is('hasil-pembelajaran*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                        ],
                        [
                            'label' => 'Prediksi',
                            'url'   => '/prediksi',
                            'active'=> request()->is('prediksi*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>'
                        ],
                        [
                            'label' => 'Laporan & Analisis',
                            'url'   => '/laporan',
                            'active'=> request()->is('laporan*'),
                            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'
                        ],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    <a href="{{ $menu['url'] }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-[13px] font-medium transition-all duration-150 {{ $menu['active'] ? 'bg-gradient-to-r from-[#2B4368] to-[#566C8D] text-white font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900' }}">
                        <svg class="w-4 h-4 shrink-0 {{ $menu['active'] ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                            {!! $menu['icon'] !!}
                        </svg>
                        <span>{{ $menu['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- Bagian Bawah: Kartu Profil Guru & Tombol Logout -->
        <div class="p-3.5 border-t border-slate-100">
            <div class="flex items-center justify-between gap-2 p-2.5 rounded-xl bg-slate-50 border border-slate-200/70">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-9 h-9 rounded-full bg-[#182B49] text-white flex items-center justify-center text-xs font-bold shrink-0" id="sidebar-avatar">
                        GR
                    </div>
                    <div class="min-w-0">
                        <p id="sidebar-user-name" class="text-xs font-bold text-slate-800 truncate">Memuat...</p>
                        <p id="sidebar-user-email" class="text-[11px] text-slate-500 truncate">Pengajar Aksara Sunda</p>
                    </div>
                </div>
                <button id="btn-logout" title="Keluar dari akun"
                    class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition cursor-pointer shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </div>
        </div>
    </aside>

    <!-- KONTEN KANAN (Topbar + Main Content) -->
    <div class="flex-1 lg:pl-[260px] flex flex-col min-w-0">
        
        <!-- Top Status Bar -->
        <header class="sticky top-0 z-20 bg-[#F8FAFC]/90 backdrop-blur-md border-b border-slate-200/60 px-4 sm:px-8 h-14 flex items-center justify-between lg:justify-end">
            <!-- Tombol Hamburger Mobile -->
            <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-200/60">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Status Koneksi Hardware & Avatar -->
            <div class="flex items-center gap-3.5">
                <div id="topbar-board-status" class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-slate-200/80 text-xs font-medium text-slate-600 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>RFID Board Active</span>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-slate-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
            </div>
        </header>

        <!-- Area Konten Utama -->
        <main class="flex-1 p-4 sm:p-8 max-w-[1380px] w-full mx-auto">
            @yield('content')
        </main>
    </div>

    <!-- Komponen Loading Overlay SUNDARA -->
    <x-loading-overlay />

    <!-- Global Auth Guard, Google SSO Token Handler & Logout Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function checkAuth() {
            const token = localStorage.getItem('sso_token');
            if (!token) {
                window.location.replace('/login');
            }
        }

        // Tangkap Token dari Redirect Google SSO
        const urlParams = new URLSearchParams(window.location.search);
        const tokenFromUrl = urlParams.get('token');
        const nameFromUrl = urlParams.get('name');

        if (tokenFromUrl) {
            localStorage.setItem('sso_token', tokenFromUrl);
            if (nameFromUrl) {
                localStorage.setItem('user_data', JSON.stringify({ name: decodeURIComponent(nameFromUrl) }));
            }
            window.history.replaceState({}, document.title, window.location.pathname);

            document.addEventListener('DOMContentLoaded', () => {
                if (typeof showSundaraIntro === 'function') {
                    showSundaraIntro('Autentikasi Google berhasil, menyiapkan Dashboard Guru...', 700);
                }
            });
        }

        checkAuth();

        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                checkAuth();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const userStr = localStorage.getItem('user_data');
            if (userStr) {
                try {
                    const user = JSON.parse(userStr);
                    if (user.name) {
                        const sidebarName = document.getElementById('sidebar-user-name');
                        const sidebarAvatar = document.getElementById('sidebar-avatar');
                        const greetingName = document.getElementById('greeting-user-name');

                        if (sidebarName) sidebarName.innerText = user.name;
                        if (greetingName) greetingName.innerText = user.name;

                        // Inisial nama untuk avatar
                        if (sidebarAvatar) {
                            const initials = user.name.split(' ').map(n => n[0]).slice(0, 2).join('').toUpperCase();
                            sidebarAvatar.innerText = initials || 'GR';
                        }
                    }
                    if (user.email) {
                        const sidebarEmail = document.getElementById('sidebar-user-email');
                        if (sidebarEmail) sidebarEmail.innerText = user.email;
                    }
                } catch (e) {
                    console.error('Error parsing user data:', e);
                }
            }

            // Handler Logout
            const logoutBtn = document.getElementById('btn-logout');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const token = localStorage.getItem('sso_token');

                    showSundaraTransition('Mengakhiri sesi & mengamankan data...', '/login', 600);

                    fetch('/api/auth/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).finally(() => {
                        localStorage.clear();
                    });
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html> 
