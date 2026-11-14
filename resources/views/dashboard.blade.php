@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
    <!-- HEADER GREETING & BADGE TAHUN AJARAN -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl sm:text-[26px] font-bold text-slate-900 tracking-tight">
                Halo, <span id="greeting-user-name">Guru SUNDARA</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Ringkasan aktivitas evaluasi aksara Sunda dan status perangkat pembelajaran hari ini.
            </p>
        </div>

        <!-- Badge Tahun Ajaran -->
        <div class="inline-flex items-center gap-3 px-4 py-2.5 bg-white rounded-xl border border-slate-200/80 shadow-2xs self-start sm:self-auto">
            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-800 leading-tight">Tahun Ajaran 2026/2027</p>
                <p class="text-[11px] text-slate-500 mt-0.5">Semester Ganjil • SMP</p>
            </div>
        </div>
    </div>

    <!-- BARIS 1: 4 KARTU RINGKASAN UTAMA -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        
        <!-- Kartu 1: Total Kelas -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-600">Total Kelas</span>
                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <span id="stat-total-classes" class="text-3xl font-bold text-slate-900">-</span>
                    <span class="text-xs font-medium text-slate-500">Kelas Aktif</span>
                </div>
                <div id="stat-classes-badges" class="mt-3 flex flex-wrap gap-1.5">
                    <!-- Dinamis -->
                </div>
            </div>
        </div>

        <!-- Kartu 2: Total Siswa -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-600">Total Siswa</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-baseline gap-2">
                    <span id="stat-total-students" class="text-3xl font-bold text-slate-900">-</span>
                    <span class="text-xs font-medium text-slate-500">Siswa Terdaftar</span>
                </div>
                <div class="mt-3 flex items-center gap-1.5 text-[11px] font-medium text-emerald-600">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span id="stat-ai-status">Analisis AI & Kelas Siap</span>
                </div>
            </div>
        </div>

        <!-- Kartu 3: Total Soal & Evaluasi -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-600">Total Soal & Evaluasi</span>
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3">
                <div class="flex items-baseline gap-2">
                    <span id="stat-total-questions" class="text-3xl font-bold text-slate-900">-</span>
                    <span class="text-xs font-medium text-slate-500">Soal Kata</span>
                </div>
                <div class="mt-2.5 space-y-1 text-[11px] text-slate-600">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span>Pengenalan</span>
                        <span id="q-pengenalan" class="font-semibold text-slate-800">-</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-indigo-500"></span>Swara</span>
                        <span id="q-swara" class="font-semibold text-slate-800">-</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-purple-500"></span>Ngalagena</span>
                        <span id="q-ngalagena" class="font-semibold text-slate-800">-</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-600"></span>Campur</span>
                        <span id="q-campur" class="font-semibold text-slate-800">-</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu 4: Status Smart Board -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between gap-2">
                    <span class="text-xs font-semibold text-slate-600 leading-snug">Status Smart<br>Board (IoT)</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/70 text-[11px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Terhubung
                    </span>
                </div>
                <p class="mt-2 text-xs font-bold text-slate-800">RFID Smart Board Lab Bahasa 1</p>
                <p class="mt-0.5 text-[11px] text-slate-500 flex items-center gap-1">
                    <span class="text-emerald-600 font-bold">((•))</span> Media Kartu Huruf Siap
                </p>
            </div>

            <div class="mt-4 space-y-2">
                <a href="/sesi-pembelajaran"
                   class="w-full py-2 px-3 rounded-xl bg-[#182B49] hover:bg-[#101F36] text-white text-xs font-semibold flex items-center justify-center gap-1.5 shadow-2xs transition">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <span>Mulai Sesi</span>
                </a>
            </div>
        </div>
    </div>

    <!-- BARIS 2: ANALITIK PENGUASAAN SISWA & KATEGORI AKSARA -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">
        
        <!-- Kiri: Distribusi Tingkat Penguasaan Siswa -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Distribusi Tingkat Penguasaan Siswa</h2>
                <p class="text-xs text-slate-500 mt-0.5">Evaluasi menyeluruh siswa pada seluruh unit aksara</p>

                <div class="my-6 flex flex-col sm:flex-row items-center justify-center gap-7">
                    <!-- Donut Chart Dinamis -->
                    <div id="donut-chart-container" class="relative w-40 h-40 rounded-full flex items-center justify-center shrink-0"
                         style="background: conic-gradient(#248249 0% 53%, #EAB308 53% 86%, #D9534F 86% 100%);">
                        <div class="w-26 h-26 bg-white rounded-full flex flex-col items-center justify-center shadow-inner">
                            <span id="donut-total-students" class="text-2xl font-bold text-slate-900 leading-none">128</span>
                            <span class="text-[11px] font-medium text-slate-500 mt-1">Total Siswa</span>
                        </div>
                    </div>

                    <!-- 3 Kartu Kategori Status -->
                    <div class="w-full space-y-2.5">
                        <div class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-emerald-50/80 border border-emerald-200/60">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-semibold text-emerald-900">Menguasai</span>
                            </div>
                            <div class="text-right">
                                <span id="stat-menguasai-count" class="text-sm font-bold text-emerald-700">68</span>
                                <span id="stat-menguasai-pct" class="text-[11px] text-emerald-700/80">(53%)</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-amber-50/80 border border-amber-200/60">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <span class="text-xs font-semibold text-amber-900">Cukup Menguasai</span>
                            </div>
                            <div class="text-right">
                                <span id="stat-cukup-count" class="text-sm font-bold text-amber-700">42</span>
                                <span id="stat-cukup-pct" class="text-[11px] text-amber-700/80">(33%)</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-red-50/80 border border-red-200/60">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="text-xs font-semibold text-red-900">Belum Menguasai</span>
                            </div>
                            <div class="text-right">
                                <span id="stat-belum-count" class="text-sm font-bold text-red-700">18</span>
                                <span id="stat-belum-pct" class="text-[11px] text-red-700/80">(14%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex items-center gap-2 text-[11px] text-slate-500">
                <svg class="w-4 h-4 text-indigo-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Target ketuntasan kurikulum minimal 80% siswa mencapai kategori 'Menguasai'.</span>
            </div>
        </div>

        <!-- Kanan: Rata-rata Penguasaan per Kategori Aksara -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-slate-900">Rata-rata Penguasaan per Kategori Aksara</h2>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">Tingkat akurasi pembacaan dan penyusunan kartu RFID</p>

                <div class="mt-5 space-y-4">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 font-bold flex items-center gap-1.5">
                                Aksara Swara <span class="font-normal text-slate-500 font-sundanese text-xs">ᮃ ᮄ (Vokal Mandiri)</span>
                            </span>
                            <span class="text-sm font-bold text-indigo-700">86%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mb-1">
                            <div class="h-full bg-[#4F46E5] rounded-full" style="width: 86%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400">Tingkat retensi paling tinggi, bentuk grafis konsisten dikenali.</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 font-bold flex items-center gap-1.5">
                                Aksara Ngalagena <span class="font-normal text-slate-500 font-sundanese text-xs">ᮊ ᮌ (Konsonan Dasar)</span>
                            </span>
                            <span class="text-sm font-bold text-purple-700">74%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mb-1">
                            <div class="h-full bg-[#7C3AED] rounded-full" style="width: 74%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400">Tantangan utama pada distorsi fonem mirip (misal: ᮍ dan ᮔ).</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-800 font-bold flex items-center gap-1.5">
                                Rarangkén <span class="font-normal text-slate-500 font-sundanese text-xs">᮪ (Vokalisasi & Bunyi Akhir)</span>
                            </span>
                            <span class="text-sm font-bold text-amber-800">58%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mb-1">
                            <div class="h-full bg-[#92400E] rounded-full" style="width: 58%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400">Perlu perhatian khusus pada aturan posisi vokalisasi atas, bawah, dan samping.</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                <span>Berdasarkan 320 log penempatan kartu pada Smart Board</span>
                <span class="font-bold text-slate-700">Akurasi Rata-rata: 72.6%</span>
            </div>
        </div>
    </div>

    <!-- BARIS 3: SESI TERBARU & SISWA YANG PERLU LATIHAN -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        
        <!-- Sesi Terbaru -->
        <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-1">
                    <h2 class="text-base font-bold text-slate-900">Sesi Terbaru</h2>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-xs text-slate-500 mb-4">Aktivitas evaluasi interaktif pada RFID Smart Board</p>

                <div id="recent-sessions-list" class="divide-y divide-slate-100 space-y-3.5">
                    <!-- Item Sesi 1 -->
                    <div class="flex items-center justify-between pt-3.5 first:pt-0">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">AP</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Aditya Pratama <span class="font-normal text-slate-500 text-[11px] ml-1">VII-A</span></p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Hari ini, 09:40 WIB • Kata: <strong class="text-slate-700">"KAMANA"</strong> <span class="font-sundanese text-indigo-700 ml-1">ᮊᮙᮔ</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">Menguasai</span>
                            <p class="text-[10px] text-slate-400 mt-1 font-mono">Skor: 95% • 42s</p>
                        </div>
                    </div>

                    <!-- Item Sesi 2 -->
                    <div class="flex items-center justify-between pt-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">SN</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Siti Nurhaliza <span class="font-normal text-slate-500 text-[11px] ml-1">VII-A</span></p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Hari ini, 09:25 WIB • Kata: <strong class="text-slate-700">"BANDUNG"</strong> <span class="font-sundanese text-indigo-700 ml-1">ᮘᮔ᮪ᮓᮥᮍ᮪</span> <span class="text-[10px] text-amber-600 block">(Perlu Rarangkén)</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold">Cukup Menguasai</span>
                            <p class="text-[10px] text-slate-400 mt-1 font-mono">Skor: 70%</p>
                        </div>
                    </div>

                    <!-- Item Sesi 3 -->
                    <div class="flex items-center justify-between pt-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">RF</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Rizky Fauzan <span class="font-normal text-slate-500 text-[11px] ml-1">VII-B</span></p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Kemarin, 14:15 WIB • Kata: <strong class="text-slate-700">"PANGALENGAN"</strong> <span class="font-sundanese text-indigo-700 ml-1">ᮕᮍᮜᮨᮍᮔ᮪</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold">Belum Menguasai</span>
                            <p class="text-[10px] text-slate-400 mt-1 font-mono">Skor: 40%</p>
                        </div>
                    </div>

                    <!-- Item Sesi 4 -->
                    <div class="flex items-center justify-between pt-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">DA</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Dewi Anggraeni <span class="font-normal text-slate-500 text-[11px] ml-1">VII-A</span></p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Kemarin, 13:50 WIB • Kata: <strong class="text-slate-700">"SUMEDANG"</strong> <span class="font-sundanese text-indigo-700 ml-1">ᮞᮥᮙᮨᮓᮍ᮪</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">Menguasai</span>
                            <p class="text-[10px] text-slate-400 mt-1 font-mono">Skor: 90%</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span>Menampilkan 4 sesi evaluasi fisik terakhir</span>
                <span class="font-semibold text-emerald-600">Sinkronisasi Board Real-Time</span>
            </div>
        </div>

        <!-- Siswa yang Perlu Latihan -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-1">
                    <h2 class="text-base font-bold text-slate-900">Siswa yang Perlu Latihan</h2>
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <p class="text-xs text-slate-500 mb-4">Prioritas pembinaan berdasarkan kategori kelemahan</p>

                <div id="remedial-students-list" class="space-y-3">
                    <!-- Item Remedial 1 -->
                    <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-[11px] flex items-center justify-center shrink-0">RF</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Rizky Fauzan <span class="font-normal text-slate-400 text-[10px]">Kelas VII-B</span></p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Perlu Penguatan: <span class="font-semibold text-amber-700">Rarangkén (Panyuku & Pamepet)</span></p>
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold shrink-0">Belum</span>
                    </div>

                    <!-- Item Remedial 2 -->
                    <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-[11px] flex items-center justify-center shrink-0">BS</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Budi Santoso <span class="font-normal text-slate-400 text-[10px]">Kelas VII-A</span></p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Perlu Penguatan: <span class="font-semibold text-amber-700">Rarangkén (Panyecek & Panglayar)</span></p>
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold shrink-0">Belum</span>
                    </div>

                    <!-- Item Remedial 3 -->
                    <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-[11px] flex items-center justify-center shrink-0">NP</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Nabila Putri <span class="font-normal text-slate-400 text-[10px]">Kelas VII-B</span></p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Perlu Penguatan: <span class="font-semibold text-indigo-700">Aksara Ngalagena (ᮏ, ᮌ, ᮔ)</span></p>
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold shrink-0">Belum</span>
                    </div>

                    <!-- Item Remedial 4 -->
                    <div class="p-3 rounded-xl bg-slate-50/80 border border-slate-200/60 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-[11px] flex items-center justify-center shrink-0">DP</div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Dimas Pratama <span class="font-normal text-slate-400 text-[10px]">Kelas VII-A</span></p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Perlu Penguatan: <span class="font-semibold text-purple-700">Aksara Swara & Rarangkén</span></p>
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold shrink-0">Belum</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 text-[11px] text-slate-400">
                <span>Rekomendasi paket kartu RFID remedial otomatis disiapkan.</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Tangkap token dari URL Google SSO redirect
    const pageUrlParams = new URLSearchParams(window.location.search);
    const urlToken = pageUrlParams.get('token');
    const urlName = pageUrlParams.get('name');

    if (urlToken) {
        localStorage.setItem('sso_token', urlToken);
        localStorage.setItem('token', urlToken);
    }
    if (urlName) {
        localStorage.setItem('user_name', decodeURIComponent(urlName));
    }
    if (urlToken || urlName) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    const token = localStorage.getItem('sso_token') || localStorage.getItem('token');
    const savedName = localStorage.getItem('user_name');
    if (savedName) {
        document.getElementById('greeting-user-name').innerText = savedName;
    }

    async function loadDashboardSummary() {
        if (!token) {
            console.error('❌ Token Auth tidak ditemukan di localStorage!');
            return;
        }

        try {
            const res = await fetch('/api/dashboard/summary', {
                headers: { 
                    'Authorization': 'Bearer ' + token, 
                    'Accept': 'application/json' 
                }
            });

            if (!res.ok) {
                console.error('❌ Gagal memuat API Dashboard. Status HTTP:', res.status);
                return;
            }

            const json = await res.json();
            if (!json.data) return;
            const data = json.data;

            // 1. Total Kelas
            document.getElementById('stat-total-classes').innerText = data.classes.total;
            document.getElementById('stat-classes-badges').innerHTML = (data.classes.list || []).map(c => `
                <span class="px-2 py-0.5 text-[11px] font-semibold bg-slate-100 text-slate-700 rounded-md">Kelas ${c}</span>
            `).join('');

            // 2. Total Siswa
            document.getElementById('stat-total-students').innerText = data.students.total;
            const aiStatusEl = document.getElementById('stat-ai-status');
            if (aiStatusEl) {
                aiStatusEl.innerText = `${data.students.total} Siswa Terdaftar`;
            }

            // 3. Total Soal
            document.getElementById('stat-total-questions').innerText = data.questions.total;
            document.getElementById('q-pengenalan').innerText = `${data.questions.pengenalan} Soal`;
            document.getElementById('q-swara').innerText = `${data.questions.swara} Soal`;
            document.getElementById('q-ngalagena').innerText = `${data.questions.ngalagena} Soal`;
            document.getElementById('q-campur').innerText = `${data.questions.campur} Soal`;

            // 4. Distribusi Penguasaan & Donut Chart
            if (data.students.menguasai) {
                const m = data.students.menguasai;
                const c = data.students.cukup;
                const b = data.students.belum;

                document.getElementById('donut-total-students').innerText = data.students.total;
                document.getElementById('stat-menguasai-count').innerText = m.count;
                document.getElementById('stat-menguasai-pct').innerText = `(${m.pct}%)`;
                document.getElementById('stat-cukup-count').innerText = c.count;
                document.getElementById('stat-cukup-pct').innerText = `(${c.pct}%)`;
                document.getElementById('stat-belum-count').innerText = b.count;
                document.getElementById('stat-belum-pct').innerText = `(${b.pct}%)`;

                const p1 = m.pct;
                const p2 = m.pct + c.pct;
                document.getElementById('donut-chart-container').style.background = 
                    `conic-gradient(#248249 0% ${p1}%, #EAB308 ${p1}% ${p2}%, #D9534F ${p2}% 100%)`;
            }

        } catch (e) {
            console.error('❌ Terjadi kesalahan jaringan:', e);
        }
    }

    document.addEventListener('DOMContentLoaded', loadDashboardSummary);
</script>
@endpush