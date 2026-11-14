@extends('layouts.app')

@section('title', 'Siswa')

@section('content')
    <!-- HEADER HALAMAN & BREADCRUMB -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-[11px] font-bold text-slate-400 tracking-wider uppercase mb-1">Manajemen Data • Tahun Ajaran 2026/2027</p>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <span>Siswa</span>
                <span class="font-sundanese text-lg text-slate-400 font-normal">ᮞᮤᮞ᮪ᮝ</span>
            </h1>
        </div>

        <button onclick="openStudentModal()"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#182B49] hover:bg-[#101F36] text-white text-xs font-semibold shadow-sm transition cursor-pointer self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Siswa</span>
        </button>
    </div>

    <!-- KONTAINER UTAMA -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-5 sm:p-6">
        
        <!-- BARIS FILTER & PENCARIAN -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                <!-- Dropdown Filter Kelas -->
                <select id="filter-class" onchange="loadStudents()"
                    class="px-3.5 py-2 rounded-xl border border-slate-200/80 bg-slate-50/50 text-xs text-slate-700 font-medium focus:outline-none focus:bg-white focus:border-[#182B49] transition">
                    <option value="">Semua Kelas</option>
                </select>

                <!-- Input Pencarian -->
                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" id="filter-search" oninput="loadStudents()" placeholder="Cari siswa..."
                        class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200/80 bg-slate-50/50 text-xs focus:outline-none focus:bg-white focus:border-[#182B49] transition">
                </div>
            </div>

            <!-- Label Total Terdata -->
            <div class="text-xs font-semibold text-slate-500 self-end sm:self-center">
                Terdata: <span id="total-terdata" class="text-slate-900 font-bold">0 Siswa</span>
            </div>
        </div>

        <!-- TABEL SISWA -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200/80 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Siswa</th>
                        <th class="py-3 px-4">Kelas</th>
                        <th class="py-3 px-4">Tingkat Penguasaan (AI)</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="students-tbody" class="divide-y divide-slate-100 text-xs">
                    <!-- Dinamis via JS -->
                </tbody>
            </table>
        </div>

        <!-- FOOTER TABEL -->
        <div class="mt-5 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-slate-500">
            <span id="footer-count">Menampilkan 0 data siswa</span>
            <span class="font-semibold text-slate-700">SUNDARA AI & IoT Smart Board Ready</span>
        </div>
    </div>

    <!-- MODAL TAMBAH / UBAH SISWA -->
    <div id="student-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h2 id="student-modal-title" class="text-base font-bold text-slate-900">Daftarkan Siswa Baru</h2>
                <button onclick="closeStudentModal()" class="p-1 text-slate-400 hover:text-slate-600 cursor-pointer">✕</button>
            </div>

            <form id="form-student" class="space-y-4">
                <input type="hidden" id="student-id">
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">NISN / NIS</label>
                        <input type="text" id="student-number" required placeholder="0092817290"
                            class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:outline-none focus:border-[#182B49]">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Kelas</label>
                        <select id="student-class" required
                            class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs bg-white focus:outline-none focus:border-[#182B49]"></select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap Siswa</label>
                    <input type="text" id="student-name" required placeholder="Nama lengkap siswa"
                        class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs focus:outline-none focus:border-[#182B49]">
                </div>

                <!-- Informasi Penjelas Terkait Sistem AI & RFID -->
                <div class="p-3.5 rounded-xl bg-indigo-50/60 border border-indigo-100/80 text-[11px] text-indigo-900 leading-relaxed flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-indigo-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Status penguasaan ortografi dan rekomendasi fokus latihan akan dianalisis dan diperbarui secara otomatis oleh sistem AI Random Forest berdasarkan hasil asesmen siswa.</span>
                </div>

                <div id="student-error" class="hidden text-xs text-red-600 bg-red-50 p-2.5 rounded-lg border border-red-200"></div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeStudentModal()"
                        class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl bg-[#182B49] hover:bg-[#101F36] text-white text-xs font-semibold cursor-pointer">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const token = localStorage.getItem('sso_token') || localStorage.getItem('token');
    let allStudents = [];

    async function initClassOptions() {
        try {
            const res = await fetch('/api/classes', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const json = await res.json();
            const filterSelect = document.getElementById('filter-class');
            const modalSelect = document.getElementById('student-class');

            (json.data || []).forEach(c => {
                filterSelect.innerHTML += `<option value="${c.id}">Kelas ${c.name}</option>`;
                modalSelect.innerHTML += `<option value="${c.id}">Kelas ${c.name}</option>`;
            });

            const urlClassId = new URLSearchParams(window.location.search).get('class_id');
            if (urlClassId) filterSelect.value = urlClassId;
        } catch (e) {
            console.error('Gagal memuat kelas:', e);
        }
    }

    async function loadStudents() {
        const classId = document.getElementById('filter-class').value;
        const searchValue = document.getElementById('filter-search').value;

        const params = new URLSearchParams();
        if (searchValue) params.append('search', searchValue);
        if (classId && classId !== '') params.append('class_room_id', classId);

        try {
            const res = await fetch(`/api/students?${params.toString()}`, {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const json = await res.json();
            allStudents = json.data || [];
            
            const tbody = document.getElementById('students-tbody');
            const totalTerdata = document.getElementById('total-terdata');
            const footerCount = document.getElementById('footer-count');

            totalTerdata.innerText = `${allStudents.length} Siswa`;
            footerCount.innerText = `Menampilkan ${allStudents.length} data siswa`;

            if (allStudents.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="py-12 text-center text-slate-400 font-medium">Tidak ada data siswa yang cocok.</td></tr>`;
                return;
            }

            const avatarColors = ['bg-[#182B49]', 'bg-indigo-700', 'bg-purple-700', 'bg-blue-800', 'bg-slate-700'];

            tbody.innerHTML = allStudents.map((s, index) => {
                const parts = s.name.split(' ');
                const initials = ((parts[0]?.[0] || '') + (parts[1]?.[0] || '')).toUpperCase();
                const bgColor = avatarColors[index % avatarColors.length];

                const mastery = s.mastery_status || s.status_penguasaan || 'belum';
                let statusBadge = '';
                if (mastery === 'menguasai' || mastery === 'Menguasai') {
                    statusBadge = `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/80 text-[11px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Menguasai
                    </span>`;
                } else if (mastery === 'cukup' || mastery === 'Cukup Menguasai') {
                    statusBadge = `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200/80 text-[11px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Cukup Menguasai
                    </span>`;
                } else {
                    statusBadge = `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Belum Diuji / Analisis AI
                    </span>`;
                }

                return `
                    <tr class="hover:bg-slate-50/85 transition">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full ${bgColor} text-white font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs">
                                    ${initials || 'S'}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">${s.name}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5 font-mono">NISN: ${s.student_number}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-[11px]">
                                ${s.class_room?.name ?? '-'}
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            ${statusBadge}
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-3">
                            <button onclick="editStudent(${s.id})" 
                                class="inline-flex items-center gap-1 text-xs font-semibold text-slate-700 hover:text-[#182B49] transition cursor-pointer">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Ubah
                            </button>
                            <button onclick="deleteStudent(${s.id}, '${s.name}')" 
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
        } catch (e) {
            console.error('Gagal memuat siswa:', e);
        }
    }

    function openStudentModal(student = null) {
        document.getElementById('student-error').classList.add('hidden');
        document.getElementById('student-modal-title').innerText = student ? 'Ubah Data Siswa' : 'Daftarkan Siswa Baru';
        document.getElementById('student-id').value = student ? student.id : '';
        document.getElementById('student-number').value = student ? student.student_number : '';
        document.getElementById('student-name').value = student ? student.name : '';
        if (student) document.getElementById('student-class').value = student.class_room_id;

        const modal = document.getElementById('student-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function editStudent(id) {
        const s = allStudents.find(item => item.id === id);
        if (s) openStudentModal(s);
    }

    function closeStudentModal() {
        const modal = document.getElementById('student-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('form-student').addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('student-id').value;
        const url = id ? `/api/students/${id}` : '/api/students';
        const method = id ? 'PUT' : 'POST';

        const errBox = document.getElementById('student-error');
        errBox.classList.add('hidden');

        try {
            const res = await fetch(url, {
                method,
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    class_room_id: document.getElementById('student-class').value,
                    student_number: document.getElementById('student-number').value,
                    name: document.getElementById('student-name').value,
                })
            });

            const data = await res.json();
            if (!res.ok) {
                errBox.innerText = data.message || 'Gagal menyimpan data siswa.';
                errBox.classList.remove('hidden');
                return;
            }

            closeStudentModal();
            loadStudents();
        } catch (err) {
            errBox.innerText = 'Terjadi kesalahan koneksi.';
            errBox.classList.remove('hidden');
        }
    });

    async function deleteStudent(id, name) {
        if (!confirm(`Hapus data siswa ${name}?`)) return;
        try {
            await fetch(`/api/students/${id}`, {
                method: 'DELETE',
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            loadStudents();
        } catch (e) {
            alert('Gagal menghapus data siswa.');
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        await initClassOptions();
        await loadStudents();
    });
</script>
@endpush