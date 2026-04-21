@extends('layouts.main')

@section('title', 'Cek Peserta')

@push('script')
    <script>
        async function cekData() {
            const nik = document.getElementById('nik').value.trim();
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');
            const card = document.getElementById('result-card');
            const statusEl = document.getElementById('status');
            const programEl = document.getElementById('programs');

            const link = document.createElement('a');
            link.href = 'https://bpjsketenagakerjaan.go.id/bpu';
            link.target = '_blank';
            link.className = 'underline font-semibold';
            link.textContent = 'bpjsketenagakerjaan.go.id/bpu';

            error.classList.add('hidden');
            card.classList.add('hidden');
            loading.classList.remove('hidden');

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
                    error.innerHTML =
                        'Anda tidak terdaftar sebagai peserta pekerja rentan Kabupaten Mimika. <br><br>' +
                        '<a href="/pengajuan" class="inline-block mt-2 px-6 py-2 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 transition">Daftar Pengajuan Baru</a>';
                    error.classList.remove('hidden');
                    return;
                }

                const d = json.data;

                document.getElementById('r-nik').innerText = d.nik;
                // document.getElementById('r-kpj').innerText = d.kpj ?? '-';
                document.getElementById('r-nama').innerText = d.nama;
                document.getElementById('r-lahir').innerText = formatTanggal(d.tgl_lahir);
                // document.getElementById('r-mulai').innerText = formatTanggal(d.tgl_kepesertaan);
                // document.getElementById('r-akhir').innerText = formatTanggal(d.tgl_berakhir);

                // PROGRAM
                programEl.innerHTML = '';
                if (d.program) {
                    Object.entries(d.program).forEach(([key, val]) => {
                        if (val) {
                            const badge = document.createElement('span');
                            badge.className =
                                'px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold';
                            badge.textContent = key.toUpperCase();
                            programEl.appendChild(badge);
                        }
                    });
                }

                const today = new Date();
                const endDate = new Date(d.tgl_berakhir);

                statusEl.innerHTML = '';

                if (endDate < today) {
                    statusEl.className =
                        'rounded-xl text-sm font-semibold text-center p-4 bg-red-100 text-red-700';

                    statusEl.innerHTML =
                        '❌ Status Kepesertaan: <b>NON-AKTIF (EXPIRED)</b><br><br>' +
                        'Silakan lakukan pengajuan pendaftaran ulang melalui link di bawah ini:<br>' +
                        '<a href="/pengajuan" class="inline-block mt-3 px-6 py-2 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition">Pengajuan Pendaftaran Ulang</a>';
                } else {
                    statusEl.className =
                        'rounded-xl text-sm font-semibold text-center p-4 bg-green-100 text-green-700';

                    statusEl.innerHTML =
                        '✅ Kepesertaan Masih Aktif<br>' +
                        '<span class="text-xs font-normal">Berlaku sampai: ' +
                        formatTanggal(d.tgl_berakhir) +
                        '</span>';
                }

                card.classList.remove('hidden');

            } catch {
                loading.classList.add('hidden');
                error.innerText = 'Terjadi kesalahan sistem';
                error.classList.remove('hidden');
            }
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
    <div class="flex flex-col md:flex-row min-h-screen w-full font-main">
        <!-- Left Section: Logos -->
        <div class="hidden md:flex md:w-1/2 bg-white relative items-center justify-center p-12">
            <div class="absolute top-12 left-12">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 md:h-32 object-contain">
            </div>
            <img src="{{ asset('img/prima-logo.png') }}" alt="Prima Logo" class="w-full max-w-md md:max-w-lg object-contain animate-fade-in">
        </div>

        <!-- Mobile Section Hero Image -->
        <div class="md:hidden w-full h-56 bg-cover bg-center relative"
            style="background-image: url('{{ asset('img/cek-peserta-bg.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
        </div>

        <!-- Right Section: Content -->
        <div class="w-full md:w-1/2 flex flex-col bg-white overflow-hidden max-h-screen relative">
            <!-- Background Image with Opacity -->
            <div class="absolute inset-0 z-0 opacity-20 pointer-events-none bg-right bg-no-repeat bg-cover"
                style="background-image: url('{{ asset('img/cek-peserta-bg.webp') }}');">
            </div>
            <!-- Inner Header -->
            <!-- Inner Header -->
            <header class="p-6 md:p-8 flex justify-between items-center w-full shrink-0 relative z-10">
                <div class="flex flex-col">
                    <a href="/"
                        class="flex items-center gap-1 md:gap-2 text-gray-400 hover:text-green-600 transition w-fit group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-6 md:w-6 transform group-hover:-translate-x-1 transition-transform"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-[12px] md:text-[14px] font-black uppercase tracking-widest">Kembali</span>
                    </a>
                </div>
            </header>

            <!-- Main Body Content: The Form -->
            <main
                class="flex-grow flex flex-col items-center justify-center px-6 py-4 overflow-y-auto animate-fade-in w-full relative z-10">
                <!-- CARD -->
                <div
                    class="w-full max-w-lg bg-white/95 backdrop-blur rounded-3xl shadow-2xl shadow-green-100/50 p-6 md:p-8 space-y-6 md:space-y-8 border border-green-50 mb-8">

                    <!-- Header -->
                    <div class="text-center space-y-2">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">
                            Cek Kepesertaan
                        </h2>
                        <p class="text-sm md:text-base text-slate-500 font-medium">
                            Masukkan NIK Anda untuk melihat status data pekerja rentan
                        </p>
                    </div>

                    <!-- Input -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-green-500 opacity-60 group-hover:opacity-100 transition-opacity"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                            </svg>
                        </div>
                        <input id="nik" type="text" maxlength="16" placeholder="Masukkan 16 Digit NIK"
                            class="w-full pl-12 pr-4 py-4 text-base sm:text-lg bg-slate-50 border border-slate-200 rounded-2xl
                                   focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:bg-white focus:outline-none transition-all font-semibold text-slate-700 placeholder-slate-400">
                    </div>

                    <!-- Button -->
                    <button onclick="cekData()"
                        class="w-full py-4 md:py-5 text-base md:text-lg rounded-2xl
                               bg-gradient-to-br from-[#28a745] to-[#1e7e34] text-white font-extrabold tracking-wide
                               hover:from-[#218838] hover:to-[#1c7430] hover:shadow-lg hover:shadow-green-300/50 hover:-translate-y-1 transition-all duration-300
                               active:scale-[0.98] flex justify-center items-center gap-2">
                        <span>Cari Data Kepesertaan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Loading & Error -->
                    <p id="loading" class="text-center text-sm text-green-600 font-bold hidden animate-pulse">
                        Mohon tunggu, sedang memeriksa data...
                    </p>
                    <div id="error"
                        class="hidden text-center text-sm text-red-600 font-medium bg-red-50 p-4 rounded-xl border border-red-100 leading-relaxed">
                    </div>

                    <!-- RESULT -->
                    <div id="result-card"
                        class="hidden bg-slate-50 border border-slate-200 rounded-2xl p-5 md:p-7 space-y-6">

                        <h3 class="font-bold text-slate-800 text-lg md:text-xl text-center border-b border-slate-200 pb-4">
                            Detail Kepesertaan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-sm md:text-base">
                            <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                <span class="block text-slate-500 text-xs md:text-sm font-medium mb-1">NIK</span>
                                <p id="r-nik" class="font-bold text-slate-800"></p>
                            </div>

                            <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                <span class="block text-slate-500 text-xs md:text-sm font-medium mb-1">Nama Lengkap</span>
                                <p id="r-nama" class="font-bold text-slate-800"></p>
                            </div>

                            <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm md:col-span-2">
                                <span class="block text-slate-500 text-xs md:text-sm font-medium mb-1">Tanggal Lahir</span>
                                <p id="r-lahir" class="font-bold text-slate-800"></p>
                            </div>

                            <!-- PROGRAM -->
                            <div class="md:col-span-2 mt-2">
                                <span class="text-slate-500 text-sm font-semibold block mb-2">Program Diikuti</span>
                                <div id="programs" class="flex flex-wrap gap-2"></div>
                            </div>
                        </div>

                        <div id="status"
                            class="rounded-xl text-sm md:text-base font-semibold text-center p-4 shadow-sm border">
                        </div>
                    </div>

                </div>
            </main>

            <!-- Inner Footer: Copyright -->
            <footer
                class="p-4 md:p-6 text-center text-[10px] md:text-xs text-gray-400 font-medium tracking-wide shrink-0 relative z-10">
                <span
                    class="px-4 md:px-6 py-2 border-t border-gray-100 italic block bg-white/50 backdrop-blur-sm rounded-full w-fit mx-auto">
                    &copy; {{ date('Y') }} BPJS Ketenagakerjaan Papua Mimika
                </span>
            </footer>

            <!-- Tribal Decoration -->
            <div class="fixed bottom-0 right-0 pointer-events-none z-0">
                <img src="{{ asset('img/tribal_bpjstk.png') }}" alt="Tribal Motif" class="w-48 md:w-80 object-contain">
            </div>
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
