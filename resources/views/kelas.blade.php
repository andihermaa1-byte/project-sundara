@extends('layouts.app')

@section('title', 'Kelas')

@section('content')
    <!-- HEADER HALAMAN -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Kelas</h1>

        <button onclick="openClassModal()"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#182B49] hover:bg-[#101F36] text-white text-xs font-semibold shadow-sm transition cursor-pointer self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Kelas</span>
        </button>
    </div>

    <!-- KONTAINER UTAMA -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-5 sm:p-6">
        
        <!-- Bar Pencarian & Simulasi Kosong -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <div class="relative w-full sm:max-w-xs">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" id="search-class" oninput="filterClasses()" placeholder="Cari kelas..."
                    class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200/80 bg-slate-50/50 text-xs focus:outline-none focus:bg-white focus:border-[#182B49] transition">
            </div>

            <button onclick="toggleEmptySimulation()"
                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200/70 text-slate-600 text-xs font-semibold transition cursor-pointer self-start sm:self-auto">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <span id="simulation-toggle-text">Simulasi Data Kosong</span>
            </button>
        </div>

        <!-- TABEL KELAS -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200/80 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Kelas</th>
                        <th class="py-3 px-4">Jumlah Siswa</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="classes-tbody" class="divide-y divide-slate-100 text-xs">
                    <!-- Dinamis via JS -->
                </tbody>
            </table>
        </div>

        <!-- FOOTER TABEL -->
        <div class="mt-5 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-slate-500">
            <span id="footer-count">Menampilkan 4 kelas aktif</span>
            <span class="font-semibold text-slate-700">SUNDARA Hardware Sync Ready</span>
        </div>
    </div>

    <!-- MODAL TAMBAH / UBAH KELAS -->
    <div id="class-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h2 id="modal-title" class="text-base font-bold text-slate-900">Tambah Kelas Baru</h2>
                <button onclick="closeClassModal()" class="p-1 text-slate-400 hover:text-slate-600 cursor-pointer">✕</button>
            </div>

            <form id="form-class" class="space-y-4">
                <input type="hidden" id="class-id">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Kelas</label>
                    <input type="text" id="class-name" placeholder="Contoh: IX-A" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:outline-none focus:border-[#182B49]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Ajaran</label>
                    <input type="text" id="class-year" value="2026/2027" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:outline-none focus:border-[#182B49]">
                </div>

                <div id="class-error" class="hidden text-xs text-red-600 bg-red-50 p-2.5 rounded-lg border border-red-200"></div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeClassModal()"
                        class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-[#182B49] hover:bg-[#101F36] text-white text-xs font-semibold cursor-pointer">
                        Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const token = localStorage.getItem('sso_token');
    let rawClasses = [];
    let isSimulatingEmpty = false;

    async function loadClasses() {
        try {
            const res = await fetch('/api/classes', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const json = await res.json();
            rawClasses = json.data || [];
            renderTable();
        } catch (e) {
            console.error('Gagal memuat kelas:', e);
        }
    }

    function renderTable() {
        const tbody = document.getElementById('classes-tbody');
        const footerCount = document.getElementById('footer-count');
        const searchTerm = document.getElementById('search-class').value.toLowerCase();

        if (isSimulatingEmpty || rawClasses.length === 0) {
            tbody.innerHTML = `<tr><td colspan="3" class="py-12 text-center text-slate-400 font-medium">Belum ada kelas aktif terdaftar.</td></tr>`;
            footerCount.innerText = 'Menampilkan 0 kelas aktif';
            return;
        }

        const filtered = rawClasses.filter(c => c.name.toLowerCase().includes(searchTerm));

        if (filtered.length === 0) {
            tbody.innerHTML = `<tr><td colspan="3" class="py-12 text-center text-slate-400 font-medium">Tidak ada kelas yang cocok dengan pencarian.</td></tr>`;
            footerCount.innerText = 'Menampilkan 0 kelas aktif';
            return;
        }

        tbody.innerHTML = filtered.map(cls => {
            const gradeText = cls.name.includes('VII') ? 'Tingkat Pertama' : (cls.name.includes('VIII') ? 'Tingkat Kedua' : 'Tingkat Lanjutan');
            const studentCount = cls.students_count ?? 32;

            return `
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="py-3.5 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#182B49] text-[#F59E0B] font-sundanese font-bold text-sm flex items-center justify-center shrink-0 shadow-2xs">
                                ᮞ
                            </div>
                            <div>
                                <a href="/siswa?class_id=${cls.id}" class="text-xs font-bold text-slate-900 hover:text-[#182B49] hover:underline">
                                    Kelas ${cls.name}
                                </a>
                                <p class="text-[11px] text-slate-400 mt-0.5">${gradeText}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3.5 px-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100/80 border border-slate-200/60 text-slate-700 text-[11px] font-semibold">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            ${studentCount} Siswa
                        </span>
                    </td>
                    <td class="py-3.5 px-4 text-right space-x-3">
                        <button onclick="openClassModal(${cls.id}, '${cls.name}', '${cls.academic_year}')" 
                            class="inline-flex items-center gap-1 text-xs font-semibold text-slate-700 hover:text-[#182B49] transition cursor-pointer">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Ubah
                        </button>
                        <button onclick="deleteClass(${cls.id}, '${cls.name}')" 
                            class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700 transition cursor-pointer">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
        }).join('');

        footerCount.innerText = `Menampilkan ${filtered.length} kelas aktif`;
    }

    function filterClasses() {
        renderTable();
    }

    function toggleEmptySimulation() {
        isSimulatingEmpty = !isSimulatingEmpty;
        const btnText = document.getElementById('simulation-toggle-text');
        btnText.innerText = isSimulatingEmpty ? 'Keluar Simulasi' : 'Simulasi Data Kosong';
        renderTable();
    }

    function openClassModal(id = null, name = '', year = '2026/2027') {
        document.getElementById('class-error').classList.add('hidden');
        document.getElementById('modal-title').innerText = id ? 'Ubah Kelas' : 'Tambah Kelas Baru';
        document.getElementById('class-id').value = id || '';
        document.getElementById('class-name').value = name;
        document.getElementById('class-year').value = year;

        const modal = document.getElementById('class-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeClassModal() {
        const modal = document.getElementById('class-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('form-class').addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('class-id').value;
        const url = id ? `/api/classes/${id}` : '/api/classes';
        // Note: Jika backend belum punya endpoint PUT /classes/{id}, kita buat atau gunakan POST
        const method = id ? 'PUT' : 'POST';

        const errBox = document.getElementById('class-error');
        errBox.classList.add('hidden');

        try {
            const res = await fetch(url, {
                method: method,
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: document.getElementById('class-name').value,
                    academic_year: document.getElementById('class-year').value
                })
            });

            const data = await res.json();
            if (!res.ok) {
                errBox.innerText = data.message || 'Gagal menyimpan kelas.';
                errBox.classList.remove('hidden');
                return;
            }

            closeClassModal();
            loadClasses();
        } catch (err) {
            errBox.innerText = 'Terjadi kesalahan koneksi.';
            errBox.classList.remove('hidden');
        }
    });

    async function deleteClass(id, name) {
        if (!confirm(`Hapus kelas ${name}?`)) return;
        try {
            await fetch(`/api/classes/${id}`, {
                method: 'DELETE',
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            loadClasses();
        } catch (e) {
            alert('Gagal menghapus kelas.');
        }
    }

    document.addEventListener('DOMContentLoaded', loadClasses);
</script>
@endpush