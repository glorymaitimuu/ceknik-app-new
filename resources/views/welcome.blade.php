@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <div class="flex flex-col md:flex-row min-h-screen w-full font-main">
        <!-- Section: Branding (Top on Mobile, Left on Desktop) -->
        <div
            class="flex flex-col md:w-1/2 bg-white relative items-center justify-center p-8 md:p-12 overflow-hidden min-h-[200px] md:min-h-screen">
            <div class="absolute top-6 left-6">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 md:h-16 object-contain">
            </div>

            <div class="relative z-10 w-40 md:w-full md:max-w-lg animate-fade-in flex flex-col items-center">
                <img src="{{ asset('img/prima-logo.png') }}" alt="Prima Logo" class="w-full object-contain">
            </div>

            <!-- Bottom Information (Desktop Only) -->
            <div
                class="hidden md:block absolute bottom-0 inset-x-0 bg-gradient-to-r from-[#28a745] to-[#1e7e34] py-3 text-center z-20">
                <span class="text-white text-[10px] md:text-xs font-semibold tracking-wide uppercase italic">
                    &copy; {{ date('Y') }} BPJS Ketenagakerjaan Papua Mimika
                </span>
            </div>

            <!-- Soft Vertical Split Blend (Desktop Only) -->
            <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-slate-50 to-transparent z-0"></div>
        </div>

        <!-- Right Section: Content -->
        <div class="w-full md:w-1/2 flex flex-col bg-white overflow-hidden relative min-h-screen">
            <!-- Background Image with Opacity -->
            <div class="absolute inset-0 z-0 opacity-20 pointer-events-none bg-right bg-no-repeat bg-cover"
                style="background-image: url('{{ asset('img/welcome-bg2.webp') }}');">
            </div>

            <!-- Main Body Content -->
            <main
                class="flex-grow flex flex-col items-center justify-center px-6 md:px-16 py-4 md:py-8 text-center max-w-2xl mx-auto w-full animate-fade-in overflow-y-auto relative z-10">
                <div class="space-y-2 md:space-y-4 mb-6 md:mb-10 px-4">
                    <h2 class="text-base md:text-xl font-bold text-gray-700 tracking-[0.2em] uppercase">Selamat Datang di
                    </h2>
                    <h3 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-[1.1] tracking-tighter">
                        Portal Pekerja Rentan<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-[#28a745] to-[#16A34A] drop-shadow-sm">BPJS
                            Ketenagakerjaan</span>
                        <br><span class="text-gray-900 md:text-4xl text-2xl">Papua Mimika</span>
                    </h3>
                </div>

                <!-- Action Buttons Container -->
                <div class="w-full space-y-4 md:space-y-6 px-4">
                    <!-- Button 1: Cek Kepesertaan -->
                    <a href="/cek-nik"
                        class="group flex items-center bg-gradient-to-br from-[#28a745] to-[#1e7e34] hover:from-[#218838] hover:to-[#1c7430] text-white rounded-[2rem] p-4 md:p-6 transition-all duration-500 shadow-xl shadow-green-200/50 hover:shadow-2xl hover:shadow-green-300/50 hover:-translate-y-1 active:scale-95 border border-white/20">
                        <div
                            class="bg-white/20 p-3 md:p-4 rounded-full mr-4 md:mr-6 transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-10 md:w-10" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <span class="text-lg md:text-2xl font-extrabold tracking-tight text-left leading-tight">Cek
                            Kepesertaan<br>Pekerja Rentan</span>
                    </a>

                    <!-- Button 2: Pengajuan Data -->
                    <a href="/pengajuan"
                        class="group flex items-center bg-gradient-to-br from-[#28a745] to-[#1e7e34] hover:from-[#218838] hover:to-[#1c7430] text-white rounded-[2rem] p-4 md:p-6 transition-all duration-500 shadow-xl shadow-green-200/50 hover:shadow-2xl hover:shadow-green-300/50 hover:-translate-y-1 active:scale-95 border border-white/20">
                        <div
                            class="bg-white/20 p-3 md:p-4 rounded-full mr-4 md:mr-6 transition-all duration-500 group-hover:scale-110 group-hover:rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-10 md:w-10" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <span class="text-lg md:text-2xl font-extrabold tracking-tight text-left leading-tight">Pengajuan
                            Data<br>Pekerja Rentan</span>
                    </a>
                </div>
            </main>


            <!-- Tribal Decoration -->
            <div class="fixed bottom-0 right-0 pointer-events-none z-0">
                <img src="{{ asset('img/tribal_bpjstk.png') }}" alt="Tribal Motif"
                    class="w-48 md:w-80 object-contain opacity-30 md:opacity-100">
            </div>

            <!-- Mobile Specific Footer (Hidden on Desktop) -->
            <div class="md:hidden bg-gradient-to-r from-[#28a745] to-[#1e7e34] py-4 px-6 text-center z-10 mt-auto">
                <span class="text-white text-[10px] font-bold tracking-tight uppercase italic block">
                    &copy; {{ date('Y') }} BPJS Ketenagakerjaan
                </span>
                <span class="text-white/80 text-[8px] uppercase tracking-widest mt-1 block">
                    Papua Mimika
                </span>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 1.2s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
