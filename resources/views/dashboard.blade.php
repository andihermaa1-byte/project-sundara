<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SUNDARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-emerald-600">SUNDARA</span>
                </div>
                <div class="flex items-center gap-4">
                    <span id="user-name" class="text-sm font-medium text-slate-700"></span>
                    <button id="btn-logout" class="px-3 py-1.5 text-xs text-red-600 border border-red-200 rounded-md hover:bg-red-50">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h2 class="text-xl font-bold text-slate-800">Selamat Datang di Panel Kendali Guru</h2>
            <p class="mt-1 text-sm text-slate-500">Gunakan menu ini untuk memilih kelas, mengaktifkan sesi Smart Board, dan melihat evaluasi siswa.</p>
        </div>
    </div>

    <script>
        // 1. Fungsi Pengecekan Autentikasi
        function checkAuth() {
            const token = localStorage.getItem('sso_token');
            if (!token) {
                // Gunakan replace agar history dashboard ditimpa
                window.location.replace('/login');
            }
        }

        // 2. Tangkap Token & Nama dari URL Parameter (saat redirect dari SSO Google)
        const urlParams = new URLSearchParams(window.location.search);
        const tokenFromUrl = urlParams.get('token');
        const nameFromUrl = urlParams.get('name');

        if (tokenFromUrl) {
            localStorage.setItem('sso_token', tokenFromUrl);
            if (nameFromUrl) {
                localStorage.setItem('user_data', JSON.stringify({ name: decodeURIComponent(nameFromUrl) }));
            }
            // Bersihkan query string token dari URL bar browser
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        // 3. Jalankan Proteksi Awal
        checkAuth();

        // 4. Proteksi saat user klik tombol BACK di browser (Mencegah caching bfcache)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                checkAuth();
            }
        });

        // 5. Tampilkan Nama User & Setup Event Handler Logout
        document.addEventListener('DOMContentLoaded', function() {
            const userStr = localStorage.getItem('user_data');
            if (userStr) {
                try {
                    const user = JSON.parse(userStr);
                    const nameElement = document.getElementById('user-name');
                    if (nameElement && user.name) {
                        nameElement.innerText = user.name;
                    }
                } catch (e) {
                    console.error('Error parsing user data:', e);
                }
            }

            // Handler Tombol Logout
            const logoutBtn = document.getElementById('btn-logout');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const token = localStorage.getItem('sso_token');

                    fetch('/api/auth/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).finally(() => {
                        // Bersihkan storage dan alihkan ke login dengan replace()
                        localStorage.clear();
                        window.location.replace('/login');
                    });
                });
            }
        });
    </script>
</body>
</html>