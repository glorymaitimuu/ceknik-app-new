@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <div class="relative min-h-screen w-full font-main overflow-hidden bg-white">
        <!-- Main Background Image -->
        <div class="absolute inset-0 z-0">
            <!-- Image on the right -->
            <div class="absolute inset-y-0 right-0 w-full md:w-[70%]">
                <img src="{{ asset('img/welcome-bg2.webp') }}" alt="Background"
                    class="w-full h-full object-cover object-center">
            </div>
            <!-- Solid White to Transparent Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-white from-[35%] to-transparent"></div>
        </div>

        <!-- Header Logos -->
        <header class="relative z-20 flex justify-between items-start p-2 md:p-4 mx-auto w-full">
            <div class="flex items-center">
                <img src="{{ asset('img/logo.png') }}" alt="BPJS Ketenagakerjaan" class="h-12 md:h-24 object-contain">
            </div>

            <!-- Logo Box with Tagline -->
            <div
                class="flex items-center bg-white rounded-2xl md:rounded-3xl px-2 md:px-6 py-1 md:py-2 shadow-md border border-gray-100">
                <img src="{{ asset('img/prima-logo.png') }}" alt="PRIMA" class="h-8 md:h-20 object-contain pr-4">
                <div class="h-8 md:h-12 w-[1px] bg-gray-200 mx-1 md:mx-4"></div>
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-8 md:w-8" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5">
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
                    <img src="{{ asset('img/ornamen1.png') }}" alt="Ornamen" class="h-8 md:h-16 object-contain">
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="relative z-20 flex flex-col items-start px-12 md:px-20 pt-12 md:pt-4 mx-auto w-full">
            <!-- Welcome Label -->
            <div class="flex items-center gap-2 mb-2 md:mb-4">
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" viewBox="0 0 24 24" fill="none"
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
                <h2 class="text-[10px] md:text-sm font-black text-[#009245] tracking-[0.2em] uppercase">Selamat Datang di
                </h2>
            </div>

            <!-- Main Title -->
            <h1 class="font-poppins text-4xl md:text-6xl font-black text-[#004a2f] leading-[0.9] mb-2 tracking-tight">
                Portal<br><span class="text-[#009245]">Pekerja Rentan</span>
            </h1>
            <h3 class="font-poppins text-xl md:text-3xl font-bold text-[#004a2f] mb-1">
                BPJS Ketenagakerjaan
            </h3>
            <p class="font-poppins text-lg md:text-2xl text-gray-500 font-medium mb-3">Papua Mimika</p>
            <div class="flex items-center mb-6">
                <div class="h-1.5 w-12 md:w-16 bg-[#009245] rounded-l-full"></div>
                <div class="h-1.5 w-6 md:w-8 bg-[#c4d600] rounded-r-full"></div>
            </div>

            <!-- Description -->
            <p class="max-w-md text-gray-600 text-sm md:text-base leading-relaxed mb-4 font-medium">
                Layanan digital untuk kemudahan akses informasi kepesertaan dan pengajuan data pekerja rentan di Kabupaten
                Mimika.
            </p>

            <!-- Buttons Area -->
            <div class="flex flex-col md:flex-row gap-4 md:gap-6 mb-12 md:mb-16 w-full md:w-auto">
                <!-- Button 1: Cek Kepesertaan -->
                <a href="/cek-nik"
                    class="group flex items-center justify-between bg-[#009245] hover:bg-[#006837] text-white rounded-xl md:rounded-2xl p-1.5 md:p-2 transition-all duration-300 shadow-xl w-full md:w-[320px]">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="bg-white p-2 md:p-3 rounded-full text-[#009245] shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <span class="text-sm md:text-xl font-black tracking-tight">Cek Kepesertaan</span>
                    </div>
                    <div
                        class="bg-white p-1 md:p-1.5 rounded-full text-[#009245] group-hover:translate-x-1 transition-transform mr-1 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-5 md:w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <!-- Button 2: Ajukan Data -->
                <a href="/pengajuan"
                    class="group flex items-center justify-between bg-white border-[2px] border-[#009245] text-[#006837] hover:bg-green-50 rounded-xl md:rounded-2xl p-1.5 md:p-2 transition-all duration-300 shadow-xl w-full md:w-[320px]">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="border-[1.5px] border-[#009245]/20 p-2 md:p-3 rounded-full text-[#009245]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-6 md:w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <span class="text-sm md:text-xl font-black tracking-tight text-[#004a2f]">Ajukan Data</span>
                    </div>
                    <div
                        class="border-[1.5px] border-[#009245]/20 rounded-full p-1 md:p-1.5 text-gray-400 group-hover:translate-x-1 transition-transform mr-1 group-hover:text-[#009245]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-5 md:w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>
            </div>

            <!-- Info Cards Section -->
            <div
                class="md:w-[75%] bg-white rounded-2xl md:rounded-[2rem] shadow-xl p-4 md:p-8 md:py-10 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-0 border border-gray-100 relative z-10">
                <!-- Card 1 -->
                <div class="flex items-center gap-3 md:px-6 md:border-r border-gray-100">
                    <div class="bg-[#f0f9f4] p-2 md:p-5 rounded-full text-[#009245] shadow-inner shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-10 md:w-10" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs md:text-xl font-bold text-[#1e293b] leading-tight mb-0.5">Aman & Terpercaya</h4>
                        <p class="text-[9px] md:text-sm text-[#64748b] font-medium leading-tight">Data anda terlindungi
                            sesuai standar keamanan BPJS Ketenagakerjaan.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex items-center gap-3 md:px-6 md:border-r border-gray-100">
                    <div class="bg-[#f0f9f4] p-2 md:p-5 rounded-full text-[#009245] shadow-inner shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-10 md:w-10" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                            <path d="M2 12h3M19 12h3M12 2v3M12 19v3"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs md:text-xl font-bold text-[#1e293b] leading-tight mb-0.5">Cepat & Mudah</h4>
                        <p class="text-[9px] md:text-sm text-[#64748b] font-medium leading-tight">Proses cepat, praktis dan
                            bisa diakses kapan saja.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex items-center gap-3 md:px-6">
                    <div class="bg-[#f0f9f4] p-2 md:p-5 rounded-full text-[#009245] shadow-inner shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-10 md:w-10" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs md:text-xl font-bold text-[#1e293b] leading-tight mb-0.5">Untuk Semua</h4>
                        <p class="text-[9px] md:text-sm text-[#64748b] font-medium leading-tight">Didedikasikan untuk
                            Pekerja Rentan di seluruh Kabupaten Mimika.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-center gap-2 text-slate-400 bg-white/80 md:bg-transparent backdrop-blur-sm md:backdrop-blur-none px-3 py-1.5 md:p-0 rounded-full md:rounded-none shadow-sm md:shadow-none border border-gray-100 md:border-none z-10 relative">
                <span class="text-[9px] md:text-[12px] font-black uppercase tracking-widest whitespace-nowrap">© 2026 BPJS Ketenagakerjaan Papua Mimika</span>
            </div>
        </main>

        <!-- Graphic Element in bottom right -->
        <div class="absolute bottom-0 right-0 z-0 pointer-events-none max-w-[400px]">
            <img src="{{ asset('img/tribal_bpjstk.png') }}" alt="Tribal" class="w-full object-contain">
        </div>
    </div>
@endsection
