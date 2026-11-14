<!-- Overlay Transisi Halaman SUNDARA -->
<div id="sundara-loader"
     style="display: none; opacity: 0; transition: opacity 0.25s ease;"
     class="fixed inset-0 z-[9999] flex-col items-center justify-center bg-[#182B49]/95 backdrop-blur-md">
    
    <!-- Ring Animasi Berputar & Logo Aksara -->
    <div class="relative flex items-center justify-center">
        <!-- Lingkaran Luar Berputar -->
        <div class="w-24 h-24 rounded-full border-4 border-white/15 border-t-[#F59E0B] border-r-[#EAB308] animate-spin"></div>
        
        <!-- Kotak Logo Tengah -->
        <div class="absolute w-16 h-16 rounded-2xl bg-[#243B61] border border-white/15 flex items-center justify-center shadow-lg">
            <span class="font-sundanese text-3xl font-bold text-[#F59E0B] animate-pulse">ᮞ</span>
        </div>
    </div>

    <!-- Nama Brand & Status -->
    <h3 class="mt-6 text-xl font-bold tracking-widest text-white">SUNDARA</h3>
    <p id="sundara-loader-text" class="mt-1.5 text-xs sm:text-sm font-medium text-slate-300 tracking-wide">
        Memuat sistem...
    </p>

    <!-- Progress Bar Halus -->
    <div class="mt-5 w-48 h-1.5 bg-white/10 rounded-full overflow-hidden">
        <div id="sundara-loader-bar"
             style="width: 0%; transition: width 1.1s ease-out;"
             class="h-full bg-gradient-to-r from-[#F59E0B] to-[#FDE047]"></div>
    </div>
</div>

<script>
    // 1. Digunakan saat Login Manual, Register, dan Logout (tampil lalu pindah halaman)
    window.showSundaraTransition = function(message, targetUrl, delayMs = 1300) {
        const loader = document.getElementById('sundara-loader');
        const loaderText = document.getElementById('sundara-loader-text');
        const loaderBar = document.getElementById('sundara-loader-bar');

        if (!loader) {
            window.location.replace(targetUrl);
            return;
        }

        loaderText.innerText = message;
        loader.style.display = 'flex';

        setTimeout(() => {
            loader.style.opacity = '1';
            loaderBar.style.width = '100%';
        }, 20);

        setTimeout(() => {
            window.location.replace(targetUrl);
        }, delayMs);
    };

    // 2. Digunakan saat masuk ke Dashboard setelah memilih akun Google SSO (tampil lalu menghilang halus)
    window.showSundaraIntro = function(message, durationMs = 1300) {
        const loader = document.getElementById('sundara-loader');
        const loaderText = document.getElementById('sundara-loader-text');
        const loaderBar = document.getElementById('sundara-loader-bar');

        if (!loader) return;

        loaderText.innerText = message;
        loader.style.display = 'flex';
        loader.style.opacity = '1';

        setTimeout(() => {
            loaderBar.style.width = '100%';
        }, 20);

        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
                loaderBar.style.width = '0%';
            }, 300);
        }, durationMs);
    };
</script>