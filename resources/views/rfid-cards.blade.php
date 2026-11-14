@extends('layouts.app')

@section('title', 'Manajemen Kartu RFID')

@section('content')
<div class="max-w-[1380px] mx-auto">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Kartu RFID</h1>
            <p class="text-xs text-slate-500 mt-1">Daftarkan dan petakan UID kartu fisik ke karakter Aksara Sunda untuk perangkat smart board.</p>
        </div>
        <button onclick="openCardModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#182B49] hover:bg-[#182B49]/90 text-white text-xs font-semibold shadow-sm transition cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Kartu RFID
        </button>
    </div>

    <!-- Tabel Daftar Kartu -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-200 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Simbol Aksara</th>
                        <th class="py-3.5 px-6">Nama / Huruf</th>
                        <th class="py-3.5 px-6">UID Kartu Fisik</th>
                        <th class="py-3.5 px-6">Jenis (Type)</th>
                        <th class="py-3.5 px-6">Transliterasi Latin</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="cards-tbody" class="divide-y divide-slate-100 text-xs">
                    <tr><td colspan="6" class="py-12 text-center text-slate-400">Memuat data kartu...</td></tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3.5 bg-slate-50/50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
            <span id="card-showing-count">Menampilkan 0 kartu</span>
        </div>
    </div>
</div>

<!-- Modal Form Tambah Kartu RFID -->
<div id="card-modal" class="fixed inset-0 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl p-6 sm:p-8 w-full max-w-lg shadow-2xl border border-slate-200 my-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-900">Daftarkan Kartu RFID Baru</h3>
            <button type="button" onclick="closeCardModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition cursor-pointer">✕</button>
        </div>

        <div id="card-error" class="hidden p-3 mb-4 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl"></div>

        <form id="form-card" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1">UID Kartu Fisik (Hex / Tag ID) <span class="text-red-500">*</span></label>
                <input type="text" id="card-uid" placeholder="Contoh: 04A3892B atau UID_KA" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono uppercase bg-slate-50/50 focus:bg-white focus:outline-none focus:border-[#182B49]" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1">Nama Huruf / Label <span class="text-red-500">*</span></label>
                <input type="text" id="card-name" placeholder="Contoh: Ka, Panghulu, A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:border-[#182B49]" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1">Karakter Aksara Sunda (Simbol) <span class="text-red-500">*</span></label>
                <input type="text" id="card-char" placeholder="Contoh: ᮊ" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-sundanese text-base bg-white focus:outline-none focus:border-[#182B49]" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1">Jenis Aksara <span class="text-red-500">*</span></label>
                <select id="card-type" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:border-[#182B49] font-medium text-slate-800" required>
                    <option value="ngalagena">Ngalagena (Konsonan Dasar)</option>
                    <option value="swara">Swara (Vokal Mandiri)</option>
                    <option value="rarangken">Rarangken (Diakritik / Sandhangan)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1">Transliterasi Latin <span class="text-red-500">*</span></label>
                <input type="text" id="card-latin" placeholder="Contoh: ka, i, panghulu" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:border-[#182B49]" required>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" onclick="closeCardModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition cursor-pointer">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#182B49] hover:bg-[#182B49]/90 text-white text-xs font-semibold shadow-sm transition cursor-pointer">Simpan Kartu</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const token = localStorage.getItem('sso_token') || localStorage.getItem('token');

    async function loadCards() {
        try {
            const res = await fetch('/api/rfid-cards', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const json = await res.json();
            const cards = json.data || [];

            const tbody = document.getElementById('cards-tbody');
            const countSpan = document.getElementById('card-showing-count');
            if (countSpan) countSpan.innerText = `Menampilkan ${cards.length} kartu`;
            if (!tbody) return;

            if (cards.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="py-12 text-center text-slate-400">Belum ada kartu RFID yang terdaftar.</td></tr>`;
                return;
            }

            const typeColors = {
                'ngalagena': 'bg-rose-50 text-rose-700 border-rose-200',
                'swara': 'bg-purple-50 text-purple-700 border-purple-200',
                'rarangken': 'bg-amber-50 text-amber-700 border-amber-200',
            };

            tbody.innerHTML = cards.map(c => `
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="py-4 px-6 align-middle">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center font-bold text-lg text-indigo-700 font-sundanese">
                            ${c.char_sundanese}
                        </div>
                    </td>
                    <td class="py-4 px-6 align-middle font-bold text-slate-900">${c.name}</td>
                    <td class="py-4 px-6 align-middle font-mono text-slate-600">${c.uid}</td>
                    <td class="py-4 px-6 align-middle">
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold border uppercase ${typeColors[c.type] || 'bg-slate-100 text-slate-700'}">
                            ${c.type}
                        </span>
                    </td>
                    <td class="py-4 px-6 align-middle text-slate-500 font-medium">/${c.latin}/</td>
                    <td class="py-4 px-6 text-right align-middle">
                        <button onclick="deleteCard(${c.id}, '${c.name}')" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 hover:text-red-700 cursor-pointer">
                            Hapus
                        </button>
                    </td>
                </tr>
            `).join('');
        } catch (e) {
            console.error('Gagal memuat kartu:', e);
        }
    }

    function openCardModal() {
        document.getElementById('card-error').classList.add('hidden');
        document.getElementById('form-card').reset();
        document.getElementById('card-modal').classList.remove('hidden');
        document.getElementById('card-modal').classList.add('flex');
    }

    function closeCardModal() {
        document.getElementById('card-modal').classList.add('hidden');
        document.getElementById('card-modal').classList.remove('flex');
    }

    document.getElementById('form-card')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const errBox = document.getElementById('card-error');
        errBox.classList.add('hidden');

        try {
            const res = await fetch('/api/rfid-cards', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    uid: document.getElementById('card-uid').value,
                    name: document.getElementById('card-name').value,
                    char_sundanese: document.getElementById('card-char').value,
                    type: document.getElementById('card-type').value,
                    latin: document.getElementById('card-latin').value,
                })
            });

            const data = await res.json();
            if (!res.ok) {
                errBox.innerText = data.message || 'Gagal mendaftarkan kartu.';
                errBox.classList.remove('hidden');
                return;
            }

            closeCardModal();
            loadCards();
        } catch (err) {
            errBox.innerText = 'Terjadi kesalahan koneksi.';
            errBox.classList.remove('hidden');
        }
    });

    async function deleteCard(id, name) {
        if (!confirm(`Hapus kartu "${name}" dari master data?`)) return;
        await fetch(`/api/rfid-cards/${id}`, {
            method: 'DELETE',
            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });
        loadCards();
    }

    document.addEventListener('DOMContentLoaded', loadCards);
</script>
@endpush 
