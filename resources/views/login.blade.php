<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - SUNDARA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-slate-800">SUNDARA</h1>
            <p class="mt-2 text-sm text-slate-600">Smart Board Aksara Sunda Interaktif</p>
            <span class="inline-block px-3 py-1 mt-2 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">Portal Guru (SSO)</span>
        </div>

        <!-- Alert Pesan Error -->
        <div id="error-alert" class="hidden p-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
            <span id="error-message"></span>
        </div>

        <!-- Form Login Internal Email & Password -->
        <form id="login-form" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email Guru</label>
                <input type="email" id="email" required placeholder="guru@sundara.ac.id"
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Kata Sandi</label>
                <input type="password" id="password" required placeholder="••••••••"
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <button type="submit" id="btn-submit"
                class="w-full py-2.5 text-white font-medium bg-emerald-600 rounded-lg hover:bg-emerald-700 transition duration-200">
                Masuk Sistem SSO
            </button>
        </form>

        <!-- Pembatas Pembagi -->
        <div class="relative my-4">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-300"></div></div>
            <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-slate-500">Atau</span></div>
        </div>

        <!-- Tombol Google SSO -->
        <a href="/auth/google/redirect" 
           class="w-full flex items-center justify-center gap-2 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-medium hover:bg-slate-50 transition">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            Masuk dengan Akun Google
        </a>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const btnSubmit = document.getElementById('btn-submit');
            const alertBox = document.getElementById('error-alert');
            const alertMsg = document.getElementById('error-message');

            btnSubmit.disabled = true;
            btnSubmit.innerText = 'Memproses...';
            alertBox.classList.add('hidden');

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

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
                    window.location.href = '/dashboard';
                } else {
                    alertMsg.innerText = data.message || (data.errors?.email ? data.errors.email[0] : 'Login gagal');
                    alertBox.classList.remove('hidden');
                }
            } catch (err) {
                alertMsg.innerText = 'Gagal terhubung ke server API backend.';
                alertBox.classList.remove('hidden');
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.innerText = 'Masuk Sistem SSO';
            }
        });
    </script>
</body>
</html>