@extends('layouts.main')

@section('title', 'Cek Peserta')

@push('script')
    <script>
        async function cekData() {
            const nik = document.getElementById('nik').value.trim();
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');
            const errorContent = document.getElementById('error-content');
            const card = document.getElementById('result-card');
            const statusEl = document.getElementById('status');
            const programEl = document.getElementById('programs');
            const modal = document.getElementById('result-modal');

            error.classList.add('hidden');
            card.classList.add('hidden');
            loading.classList.remove('hidden');
            modal.classList.remove('hidden');

            try {
                const res = await fetch('/api/cek-peserta-bpjs', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nik
                    })
                });

                const json = await res.json();
                loading.classList.add('hidden');

                if (!res.ok) {
                    errorContent.innerHTML =
                        'Anda tidak terdaftar sebagai peserta pekerja rentan Kabupaten Mimika. <br><br>' +
                        '<a href="/pengajuan" class="inline-block mt-2 px-6 py-2 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition">Daftar Pengajuan Baru</a>';
                    error.classList.remove('hidden');
                    return;
                }

                const d = json.data;

                document.getElementById('r-nik').innerText = d.nik;
                document.getElementById('r-nama').innerText = d.nama;
                document.getElementById('r-lahir').innerText = formatTanggal(d.tgl_lahir);

                programEl.innerHTML = '';
                if (d.program) {
                    Object.entries(d.program).forEach(([key, val]) => {
                        if (val) {
                            const badge = document.createElement('span');
                            badge.className =
                                'px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold';
                            badge.textContent = key.toUpperCase();
                            programEl.appendChild(badge);
                        }
                    });
                }

                const today = new Date();
                const endDate = new Date(d.tgl_berakhir);

                statusEl.innerHTML = '';
                if (endDate < today) {
                    statusEl.className = 'rounded-xl text-sm font-semibold text-center p-4 bg-red-100 text-red-700';
                    statusEl.innerHTML =
                        '❌ Status Kepesertaan: <b>NON-AKTIF (EXPIRED)</b><br><br>' +
                        '<a href="/pengajuan" class="inline-block mt-3 px-6 py-2 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition">Pengajuan Pendaftaran Ulang</a>';
                } else {
                    statusEl.className = 'rounded-xl text-sm font-semibold text-center p-4 bg-green-100 text-green-700';
                    statusEl.innerHTML =
                        '✅ Kepesertaan Masih Aktif<br>' +
                        '<span class="text-xs font-normal">Berlaku sampai: ' + formatTanggal(d.tgl_berakhir) +
                        '</span>';
                }

                card.classList.remove('hidden');

            } catch {
                loading.classList.add('hidden');
                errorContent.innerText = 'Terjadi kesalahan sistem';
                error.classList.remove('hidden');
            }
        }

        function closeResultModal() {
            document.getElementById('result-modal').classList.add('hidden');
        }

        function formatTanggal(dateStr) {
            if (!dateStr) return '-';
            return new Date(dateStr).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }
    </script>
@endpush

@section('content')
    <div class="relative min-h-screen w-full font-main overflow-hidden bg-white">
        <!-- Main Background Image -->
        <div class="absolute inset-0 z-0">
            <!-- Image on the right -->
            <div class="absolute inset-y-0 right-0 w-full md:w-[70%]">
                <img src="{{ asset('img/cek-peserta-bg.webp') }}" alt="Background"
                    class="w-full h-full object-cover object-center">
            </div>
            <!-- Solid White to Transparent Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-white from-[35%] via-white/90 via-[45%] to-transparent"></div>
        </div>

        <!-- Header Logos (Copy from Welcome) -->
        <header class="relative z-20 flex justify-between items-start p-2 md:p-4 mx-auto w-full">
            <div class="flex flex-col items-start gap-1">
                <a href="/">
                    <img src="{{ asset('img/logo.png') }}" alt="BPJS Ketenagakerjaan" class="h-12 md:h-24 object-contain">
                </a>
                <a href="/"
                    class="flex items-center gap-1 text-gray-400 hover:text-[#009245] transition-colors text-[10px] mx-5 md:mx-9 md:text-xs font-black uppercase tracking-[0.2em]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Logo Box with Ornamen -->
            <div
                class="flex items-center bg-white rounded-2xl md:rounded-3xl px-2 md:px-6 py-1 md:py-2 shadow-md border border-gray-100">
                <img src="{{ asset('img/prima-logo.png') }}" alt="PRIMA" class="h-10 md:h-20 object-contain pr-4">
                <div class="h-8 md:h-12 w-[1px] bg-gray-200 mx-1 md:mx-4"></div>
                <div class="flex items-center gap-3 md:gap-4">
                    <img src="{{ asset('img/ornamen1.png') }}" alt="Ornamen" class="h-8 md:h-16 object-contain">
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main
            class="relative z-20 flex flex-col items-start justify-center min-h-[calc(100vh-140px)] px-10 md:px-24 py-2 mx-auto w-full pb-20">
            <!-- Welcome Label -->
            <div class="flex items-center gap-2 mb-2 md:mb-4">
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-7 md:w-7" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5" />
                        <line x1="12" y1="1" x2="12" y2="3" />
                        <line x1="12" y1="21" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="3" y2="12" />
                        <line x1="21" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                    </svg>
                </div>
                <h2 class="text-xs md:text-lg font-black text-[#009245] tracking-[0.2em] uppercase">Layanan Cepat & Mudah
                </h2>
            </div>

            <!-- Title -->
            <h1 class="font-poppins text-4xl md:text-6xl font-black text-[#004a2f] leading-[1] mb-3 tracking-tight">
                Cek Status<br><span class="text-[#009245]">Kepesertaan</span>
            </h1>

            <p class="font-poppins max-w-2xl text-gray-600 text-xs md:text-lg leading-relaxed mb-4 font-medium">
                Masukkan NIK untuk melihat status kepesertaan Anda sebagai pekerja rentan.
            </p>

            <div class="flex items-center mb-6">
                <div class="h-1.5 w-12 md:w-16 bg-[#009245] rounded-l-full"></div>
                <div class="h-1.5 w-6 md:w-8 bg-[#c4d600] rounded-r-full"></div>
            </div>

            <!-- Input & Button Form -->
            <div class="w-full max-w-xl space-y-4">
                <!-- NIK Input -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="bg-[#f0f9f4] p-1.5 rounded-lg text-[#009245]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                        </div>
                    </div>
                    <input id="nik" type="text" maxlength="16" placeholder="Masukkan 16 digit NIK"
                        class="w-full pl-16 pr-4 py-4 text-base md:text-xl bg-white border-2 border-[#009245]/20 rounded-xl md:rounded-2xl
                               focus:ring-2 focus:ring-[#009245]/10 focus:border-[#009245] focus:outline-none transition-all font-bold text-gray-800 placeholder-gray-400 shadow-md">
                </div>

                <!-- Submit Button -->
                <button onclick="cekData()"
                    class="group flex items-center justify-between bg-gradient-to-r from-[#009245] to-[#006837] hover:shadow-lg hover:shadow-green-900/10 text-white rounded-xl md:rounded-2xl p-1.5 md:p-2 transition-all duration-300 shadow-lg w-full active:scale-[0.98]">
                    <div class="flex items-center gap-3 md:gap-5 flex-1 justify-center">
                        <span class="text-base md:text-xl font-black tracking-tight">Cek Kepesertaan</span>
                    </div>
                    <div
                        class="bg-white p-1 md:p-1.5 rounded-full text-[#009245] group-hover:translate-x-1 transition-transform mr-1 shadow-sm shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </div>

            <!-- FEATURES START HERE -->
            <div class="w-full max-w-xl space-y-4 mt-8 mb-8 z-10 relative">
                <!-- Feature 1: Aman & Terpercaya -->
                <div class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition-transform hover:translate-x-2">
                    <div class="bg-gradient-to-br from-[#009245] to-[#004a2f] p-3 rounded-xl text-white shadow-lg shadow-green-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#004a2f] leading-tight">Aman & Terpercaya</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight mt-1">Data anda terlindungi sesuai standar keamanan BPJS Ketenagakerjaan.</p>
                    </div>
                </div>

                <!-- Feature 2: Cepat & Mudah -->
                <div class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition-transform hover:translate-x-2">
                    <div class="bg-[#f0f9f4] p-3 rounded-xl text-[#009245]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#004a2f] leading-tight">Cepat & Mudah</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight mt-1">Proses cepat, praktis dan bisa diakses kapan saja.</p>
                    </div>
                </div>

                <!-- Feature 3: Untuk Semua -->
                <div class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition-transform hover:translate-x-2">
                    <div class="bg-[#f0f9f4] p-3 rounded-xl text-[#009245]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#004a2f] leading-tight">Untuk Semua</h4>
                        <p class="text-[11px] text-slate-500 font-medium leading-tight mt-1">Didedikasikan untuk Pekerja Rentan di seluruh Kabupaten Mimika.</p>
                    </div>
                </div>
            </div>

            <!-- RESULT AREA MODAL -->
            <div id="result-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
                <!-- Overlay -->
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeResultModal()"></div>
                
                <!-- Modal Content Container -->
                <div class="relative w-full max-w-xl z-10">
                    <div id="loading" class="hidden w-full bg-white rounded-[2rem] shadow-2xl p-8 animate-fade-in relative">
                        <div class="flex flex-col items-center gap-4 py-10">
                            <div class="animate-spin rounded-full h-12 w-12 border-4 border-[#009245] border-t-transparent"></div>
                            <p class="text-[#009245] font-black animate-pulse">Memeriksa Data...</p>
                        </div>
                    </div>

                    <div id="error" class="hidden w-full bg-red-50 border-2 border-red-100 p-6 md:p-8 rounded-[2rem] text-center shadow-2xl animate-fade-in relative">
                        <button onclick="closeResultModal()" class="absolute top-4 right-4 text-red-400 hover:text-red-600 bg-red-100/50 hover:bg-red-100 rounded-full p-1 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <div class="text-red-500 mb-4 flex justify-center">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div id="error-content" class="text-red-700 font-bold mb-2"></div>
                    </div>

                    <div id="result-card" class="hidden w-full bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-2xl space-y-4 animate-fade-in relative overflow-hidden">
                        <button onclick="closeResultModal()" class="absolute top-4 right-4 z-20 text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full p-1 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <div class="absolute top-0 right-0 p-4 opacity-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 12l2 2 4-4m5.618-4.016A3.323 3.323 0 0010.605 2.02a3.323 3.323 0 00-4.586 4.586 3.323 3.323 0 00-4.016 5.618 3.323 3.323 0 005.618 4.016 3.323 3.323 0 004.586 4.586 3.323 3.323 0 004.016-5.618 3.323 3.323 0 00-5.618-4.016z" />
                            </svg>
                        </div>

                        <h3 class="text-2xl font-black text-[#004a2f] border-b border-gray-100 pb-4">Detail Kepesertaan</h3>

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-1">
                                <span class="text-xs font-black uppercase tracking-wider text-gray-400">NIK</span>
                                <p id="r-nik" class="text-xl font-bold text-gray-800"></p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-black uppercase tracking-wider text-gray-400">Nama Lengkap</span>
                                <p id="r-nama" class="text-xl font-bold text-gray-800 uppercase"></p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-black uppercase tracking-wider text-gray-400">Tanggal Lahir</span>
                                <p id="r-lahir" class="text-xl font-bold text-gray-800"></p>
                            </div>
                            <div class="space-y-2">
                                <span class="text-xs font-black uppercase tracking-wider text-gray-400 block">Program Diikuti</span>
                                <div id="programs" class="flex flex-wrap gap-2"></div>
                            </div>
                        </div>

                        <div id="status" class="mt-4"></div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-center gap-2 text-slate-400 bg-white/80 md:bg-transparent backdrop-blur-sm md:backdrop-blur-none px-3 py-1.5 md:p-0 rounded-full md:rounded-none shadow-sm md:shadow-none border border-gray-100 md:border-none z-10 relative">
                <span class="text-[9px] md:text-[12px] font-black uppercase tracking-widest whitespace-nowrap">© 2026 BPJS Ketenagakerjaan Papua Mimika</span>
            </div>
        </main>

        <!-- Tribal motif sweep -->
        <div class="absolute bottom-0 right-0 z-0 pointer-events-none max-w-[400px]">
            <img src="{{ asset('img/tribal_bpjstk.png') }}" alt="Tribal" class="w-full object-contain">
        </div>
    </div>

    <style>
        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
