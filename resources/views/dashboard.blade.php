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
                    <span class="text-xl font-bold text-emerald-600">SUNDARA Board</span>
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
        // Cek Token SSO saat halaman dimuat
        const token = localStorage.getItem('sso_token');
        const user = JSON.parse(localStorage.getItem('user_data') || '{}');

        if (!token) {
            window.location.href = '/login';
        } else {
            document.getElementById('user-name').innerText = user.name || 'Guru';
        }

        // Event Handler Logout
        document.getElementById('btn-logout').addEventListener('click', async function() {
            await fetch('/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });
            localStorage.clear();
            window.location.href = '/login';
        });
    </script>
</body>
</html>