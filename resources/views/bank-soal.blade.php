@extends('layouts.app')

@section('title', 'Bank Soal')

@section('content')
<div class="max-w-[1380px] mx-auto">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Bank Soal</h1>
            <p class="text-xs text-slate-500 mt-1">Manajemen target kata dan konfigurasi urutan kartu RFID untuk asesmen ortografi Aksara Sunda.</p>
        </div>
        <button onclick="openQuestionModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#182B49] hover:bg-[#182B49]/90 text-white text-xs font-semibold shadow-sm transition cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Soal
        </button>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-2xl p-4 shadow-xs border border-slate-200/80 mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div id="category-chips" class="flex flex-wrap items-center gap-2">
            <!-- Rendered by JS -->
        </div>
        <div class="relative w-full md:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" id="search-question" oninput="loadQuestions()" placeholder="Cari kata target..." 
                class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 text-xs bg-slate-50/50 focus:bg-white focus:outline-none focus:border-[#182B49] transition">
        </div>
    </div>

    <!-- Tabel Daftar Soal -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-200 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Kata / Kartu Target</th>
                        <th class="py-3.5 px-6">Aksara Sunda (Padu)</th>
                        <th class="py-3.5 px-6">Urutan Kartu</th>
                        <th class="py-3.5 px-6">Level</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="questions-tbody" class="divide-y divide-slate-100 text-xs">
                    <tr><td colspan="5" class="py-12 text-center text-slate-400">Memuat data soal...</td></tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3.5 bg-slate-50/50 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
            <span id="showing-count">Menampilkan 0 soal</span>
        </div>
    </div>
</div>

<!-- Modal Form Tambah/Ubah Soal -->
<div id="question-modal" class="fixed inset-0 hidden items-center justify-center bg-slate-900/40 backdrop-blur-xs z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl p-6 sm:p-8 w-full max-w-2xl shadow-2xl border border-slate-200 my-8">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[11px] font-semibold text-slate-400 tracking-wide uppercase">Bank Soal > <span id="breadcrumb-action" class="text-slate-700">Tambah Soal</span></span>
            <button type="button" onclick="closeQuestionModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition cursor-pointer">✕</button>
        </div>
        <p class="text-[10px] font-bold text-indigo-600 tracking-wider uppercase mb-1">Asesmen Ortografi • Penetapan Target Fisik Kartu</p>
        <h2 id="modal-title" class="text-xl font-bold text-slate-900 mb-1">Tambah Soal</h2>
        <p class="text-xs text-slate-500 mb-6">Konfigurasi kata atau kartu target dan urutan fisik kartu RFID untuk asesmen ortografi Aksara Sunda.</p>

        <div id="question-error" class="hidden p-3 mb-4 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl"></div>

        <form id="form-question" class="space-y-5">
            <input type="hidden" id="question-id">
            
            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1.5">Level Soal <span class="text-red-500">*</span></label>
                <select id="q-category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:outline-none focus:border-[#182B49] font-medium text-slate-800 shadow-2xs" required></select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-800 mb-1.5">Kata / Kartu Target (Latin) <span class="text-red-500">*</span></label>
                <input type="text" id="q-word" placeholder="KAMANA" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs font-mono uppercase bg-slate-50/50 focus:bg-white focus:outline-none focus:border-[#182B49]" required>
            </div>

            <div class="border-t border-slate-100 pt-2"></div>

            <!-- Urutan Kartu dengan Dropdown Master RFID -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <label class="text-xs font-bold text-slate-800">Urutan Kartu RFID</label>
                        <p class="text-[11px] text-slate-400">Pilih kartu berdasar master data untuk kombinasi Ngalagena / Rarangken.</p>
                    </div>
                    <span id="card-count-badge" class="text-[11px] bg-slate-100 text-slate-700 px-3 py-1 rounded-full font-bold">0 Kartu Ditentukan</span>
                </div>
                <div id="cards-container" class="space-y-2.5 mb-3 max-h-48 overflow-y-auto pr-1"></div>
                <button type="button" onclick="addCardSlot()" class="w-full py-2.5 rounded-xl border border-dashed border-indigo-300 bg-indigo-50/50 hover:bg-indigo-50 text-indigo-700 text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <span>+ Tambah Kartu</span>
                </button>
            </div>

            <!-- Pratinjau Urutan Kartu & Hasil Padu -->
            <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Hasil Aksara Padu (Pratinjau)</span>
                    <span id="modal-preview-padu" class="text-base font-bold text-indigo-900 font-sundanese bg-white px-3 py-1 rounded-xl border border-indigo-100 shadow-2xs">ᮊᮤ</span>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kombinasi Urutan Kartu</span>
                        <span class="text-[10px] text-slate-400">Kiri → Kanan</span>
                    </div>
                    <div id="preview-container" class="flex flex-wrap items-center gap-2 text-xs">
                        <span class="text-slate-400 italic">Belum ada kartu ditentukan.</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" onclick="closeQuestionModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition cursor-pointer">Batal</button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#182B49] hover:bg-[#182B49]/90 text-white text-xs font-semibold shadow-sm transition cursor-pointer">Simpan Soal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const token = localStorage.getItem('sso_token') || localStorage.getItem('token');
    let categoriesData = [];
    let rfidCardsMaster = [];
    let activeCategoryId = '';
    let allQuestions = [];

    async function initPage() {
        await loadMasterCards();
        await classManager();
    }

    async function loadMasterCards() {
        try {
            const res = await fetch('/api/rfid-cards', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const json = await res.json();
            rfidCardsMaster = json.data || [];
        } catch (e) {
            console.error('Gagal memuat master kartu RFID:', e);
        }
    }

    async function classManager() {
        try {
            const resCat = await fetch('/api/categories', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const jsonCat = await resCat.json();
            categoriesData = jsonCat.data.categories || [];
            
            const chipsContainer = document.getElementById('category-chips');
            const totalQ = jsonCat.data.total_questions || 0;

            if (chipsContainer) {
                chipsContainer.innerHTML = `
                    <button onclick="filterCategory('')" class="cat-chip px-4 py-2 rounded-xl ${activeCategoryId === '' ? 'bg-[#182B49] text-white shadow-sm' : 'bg-slate-100/80 hover:bg-slate-200/70 text-slate-700'} text-xs font-semibold transition cursor-pointer flex items-center gap-1.5">
                        <span>Semua</span>
                        <span class="px-1.5 py-0.5 rounded-md ${activeCategoryId === '' ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-600'} text-[10px]">${totalQ}</span>
                    </button>
                `;
                categoriesData.forEach(cat => {
                    const isActive = activeCategoryId === cat.id;
                    chipsContainer.innerHTML += `
                        <button onclick="filterCategory(${cat.id})" class="cat-chip px-4 py-2 rounded-xl ${isActive ? 'bg-[#182B49] text-white shadow-sm' : 'bg-slate-100/80 hover:bg-slate-200/70 text-slate-700'} text-xs font-semibold transition cursor-pointer flex items-center gap-1.5">
                            <span>${cat.name}</span>
                            <span class="px-1.5 py-0.5 rounded-md ${isActive ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-600'} text-[10px]">${cat.questions_count}</span>
                        </button>
                    `;

                    const selectModal = document.getElementById('q-category');
                    if (selectModal && !selectModal.querySelector(`option[value="${cat.id}"]`)) {
                        selectModal.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                    }
                });
            }

            loadQuestions();
        } catch (e) {
            console.error('Gagal memuat kategori:', e);
        }
    }

    function generatePaduText(sequence) {
        if (!sequence || sequence.length === 0) return '—';
        let result = '';
        sequence.forEach(cardUid => {
            const cardObj = rfidCardsMaster.find(c => c.uid === cardUid);
            if (cardObj) {
                result += cardObj.char_sundanese;
            }
        });
        return result || '—';
    }

    async function loadQuestions() {
        const searchInput = document.getElementById('search-question');
        const search = searchInput ? searchInput.value : '';
        const params = new URLSearchParams();
        if (activeCategoryId !== '') params.append('category_id', activeCategoryId);
        if (search) params.append('search', search);

        try {
            const res = await fetch(`/api/questions?${params.toString()}`, {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const json = await res.json();
            allQuestions = json.data || [];

            const tbody = document.getElementById('questions-tbody');
            const showingCount = document.getElementById('showing-count');
            if (showingCount) showingCount.innerText = `Menampilkan ${allQuestions.length} soal`;
            if (!tbody) return;

            if (allQuestions.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="py-12 text-center text-slate-400">Tidak ada soal ditemukan.</td></tr>`;
                return;
            }

            tbody.innerHTML = allQuestions.map(q => {
                const catName = q.category?.name || 'Umum';
                const sequence = q.rfid_sequence || [];
                const paduText = q.sundanese_text || generatePaduText(sequence);

                let cardsHtml = sequence.map((cardUid, idx) => {
                    const cardObj = rfidCardsMaster.find(c => c.uid === cardUid) || { name: cardUid, char_sundanese: 'ᮊ', type: 'ngalagena' };
                    return `
                        <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-white border border-slate-200 shadow-2xs">
                            <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center font-bold text-xs text-indigo-700 font-sundanese">${cardObj.char_sundanese}</div>
                            <div class="text-[11px] leading-tight pr-1">
                                <p class="font-bold text-slate-800">${cardObj.name}</p>
                                <p class="text-[10px] text-slate-400 uppercase font-semibold">${cardObj.type}</p>
                            </div>
                        </div>
                        ${idx < sequence.length - 1 ? '<span class="text-slate-300 font-bold px-0.5">+</span>' : ''}
                    `;
                }).join('');

                return `
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-4 px-6 align-middle">
                            <p class="font-bold text-slate-900 text-sm">${q.word_target}</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">/${q.word_target.toLowerCase()}/</p>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="inline-flex items-center px-3.5 py-1.5 rounded-xl bg-indigo-50/70 border border-indigo-100 text-base font-bold text-indigo-900 font-sundanese tracking-wider shadow-2xs">
                                ${paduText}
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-wrap items-center gap-1.5">${cardsHtml || '<span class="text-slate-400 italic">Tanpa kartu</span>'}</div>
                        </td>
                        <td class="py-4 px-6 align-middle"><span class="px-3 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">${catName}</span></td>
                        <td class="py-4 px-6 text-right align-middle space-x-3">
                            <button onclick="editQuestion(${q.id})" class="text-xs font-semibold text-slate-700 hover:text-[#182B49] cursor-pointer">Ubah</button>
                            <button onclick="deleteQuestion(${q.id}, '${q.word_target}')" class="text-xs font-semibold text-red-600 hover:text-red-700 cursor-pointer">Hapus</button>
                        </td>
                    </tr>
                `;
            }).join('');
        } catch (e) {
            console.error('Gagal memuat soal:', e);
        }
    }

    function filterCategory(catId) {
        activeCategoryId = catId;
        classManager();
    }

    let currentCards = [];

    function openQuestionModal(question = null) {
        document.getElementById('question-error').classList.add('hidden');
        document.getElementById('modal-title').innerText = question ? 'Ubah Soal' : 'Tambah Soal';
        document.getElementById('breadcrumb-action').innerText = question ? 'Ubah Soal' : 'Tambah Soal';
        document.getElementById('question-id').value = question ? question.id : '';
        document.getElementById('q-category').value = question ? question.category_id : (categoriesData[0]?.id || '');
        document.getElementById('q-word').value = question ? question.word_target : '';
        
        currentCards = question ? [...(question.rfid_sequence || [])] : ['UID_KA', 'UID_MA', 'UID_NA'];
        renderCardSlots();
        updatePreview();

        const modal = document.getElementById('question-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function editQuestion(id) {
        const q = allQuestions.find(item => item.id === id);
        if (q) openQuestionModal(q);
    }

    function closeQuestionModal() {
        document.getElementById('question-modal').classList.add('hidden');
        document.getElementById('question-modal').classList.remove('flex');
    }

    function renderCardSlots() {
        const container = document.getElementById('cards-container');
        document.getElementById('card-count-badge').innerText = `${currentCards.length} Kartu Ditentukan`;

        if (container) {
            container.innerHTML = currentCards.map((selectedUid, index) => {
                let optionsHtml = rfidCardsMaster.map(card => `
                    <option value="${card.uid}" ${card.uid === selectedUid ? 'selected' : ''}>
                        ${card.name} (${card.type}) — ${card.char_sundanese}
                    </option>
                `).join('');

                return `
                    <div class="flex items-center gap-2 p-2.5 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center justify-center w-7 h-7 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700">${index + 1}</div>
                        <select onchange="updateCardValue(${index}, this.value)" class="flex-1 px-3.5 py-2 rounded-xl border border-slate-200 text-xs font-medium bg-white focus:outline-none focus:border-[#182B49] cursor-pointer">
                            ${optionsHtml}
                        </select>
                        <button type="button" onclick="removeCardSlot(${index})" class="p-2 text-slate-400 hover:text-red-600 transition cursor-pointer">✕</button>
                    </div>
                `;
            }).join('');
        }
    }

    function addCardSlot() {
        const defaultCard = rfidCardsMaster[0]?.uid || 'UID_KA';
        currentCards.push(defaultCard);
        renderCardSlots();
        updatePreview();
    }

    function removeCardSlot(index) {
        currentCards.splice(index, 1);
        renderCardSlots();
        updatePreview();
    }

    function updateCardValue(index, val) {
        currentCards[index] = val;
        updatePreview();
    }

    function updatePreview() {
        const preview = document.getElementById('preview-container');
        const previewPadu = document.getElementById('modal-preview-padu');
        if (!preview) return;

        const paduString = generatePaduText(currentCards);
        if (previewPadu) previewPadu.innerText = paduString;

        if (currentCards.length === 0) {
            preview.innerHTML = `<span class="text-slate-400 italic">Belum ada kartu ditentukan.</span>`;
            if (previewPadu) previewPadu.innerText = '—';
            return;
        }

        preview.innerHTML = currentCards.map((cardUid, idx) => {
            const cardObj = rfidCardsMaster.find(c => c.uid === cardUid) || { name: cardUid, char_sundanese: 'ᮊ', type: 'ngalagena' };
            const isRarangken = cardObj.type === 'rarangken';
            return `
                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white border border-slate-200 shadow-2xs">
                    <span class="font-bold text-sm text-indigo-700 font-sundanese">${cardObj.char_sundanese}</span>
                    <div>
                        <p class="font-bold text-slate-900 text-xs">${cardObj.name}</p>
                        <p class="text-[10px] ${isRarangken ? 'text-amber-600' : 'text-rose-600'} font-semibold uppercase">${cardObj.type}</p>
                    </div>
                </div>
                ${idx < currentCards.length - 1 ? '<span class="text-slate-300 font-bold px-1">→</span>' : ''}
            `;
        }).join('');
    }

    document.addEventListener('DOMContentLoaded', initPage);

    document.getElementById('form-question')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('question-id').value;
        const url = id ? `/api/questions/${id}` : '/api/questions';
        const method = id ? 'PUT' : 'POST';
        const errBox = document.getElementById('question-error');
        if (errBox) errBox.classList.add('hidden');

        try {
            const res = await fetch(url, {
                method,
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({
                    category_id: document.getElementById('q-category').value,
                    word_target: document.getElementById('q-word').value,
                    sundanese_text: generatePaduText(currentCards),
                    rfid_sequence: currentCards,
                    difficulty: 1
                })
            });

            const data = await res.json();
            if (!res.ok) {
                if (errBox) {
                    errBox.innerText = data.message || 'Gagal menyimpan soal.';
                    errBox.classList.remove('hidden');
                }
                return;
            }

            closeQuestionModal();
            loadQuestions();
        } catch (err) {
            if (errBox) {
                errBox.innerText = 'Terjadi kesalahan koneksi.';
                errBox.classList.remove('hidden');
            }
        }
    });

    async function deleteQuestion(id, word) {
        if (!confirm(`Hapus soal target "${word}"?`)) return;
        await fetch(`/api/questions/${id}`, {
            method: 'DELETE',
            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });
        loadQuestions();
    }
</script>
@endpush