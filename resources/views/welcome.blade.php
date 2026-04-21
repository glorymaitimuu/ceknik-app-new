@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <div class="flex flex-col md:flex-row min-h-screen w-full font-main">
        <!-- Left Section: Logos -->
        <div class="hidden md:flex md:w-1/2 bg-white relative items-center justify-center p-12">
            <div class="absolute top-12 left-12">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 md:h-32 object-contain">
            </div>
            <img src="{{ asset('img/prima-logo.png') }}" alt="Prima Logo"
                class="w-full max-w-md md:max-w-lg object-contain animate-fade-in">
        </div>

        <!-- Mobile Section Hero Image -->
        <div class="md:hidden w-full h-72 bg-cover bg-center relative"
            style="background-image: url('{{ asset('img/welcome-bg2.webp') }}');">
            <!-- Overlay transisi putih agar menyatu mulus ke bawah untuk mobile -->
            <div class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-white via-white/60 to-transparent"></div>
        </div>

        <!-- Right Section: Content -->
        <div class="w-full md:w-1/2 flex flex-col bg-white overflow-hidden max-h-screen relative">
            <!-- Background Image with Opacity -->
            <div class="absolute inset-0 z-0 opacity-20 pointer-events-none bg-right bg-no-repeat bg-cover"
                style="background-image: url('{{ asset('img/welcome-bg2.webp') }}');">
            </div>
            <!-- Inner Header: Spacing container -->
            <header class="p-6 md:p-8 flex justify-between items-center w-full shrink-0 relative z-10 min-h-[80px]">
                <!-- Logos removed as per request -->
            </header>

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

            <!-- Copyright styled with more finesse -->
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
