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
                    // Simpan Token SSO & User Data di LocalStorage Browser
                    localStorage.setItem('sso_token', data.data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.data.user));

                    // Redirect ke Dashboard
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