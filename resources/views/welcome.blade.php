@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center px-6 py-12 text-center">
        <!-- Title Section -->
        <div class="mb-14 space-y-2">
            <h2 class="text-xl md:text-2xl text-gray-800">Selamat Datang di</h2>
            <h3 class="text-2xl md:text-4xl font-bold text-gray-900 max-w-2xl leading-snug">
                Portal Pekerja Rentan BPJS Ketenagakerjaan Papua Mimika
            </h3>
        </div>

        <!-- Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl px-4">

            <!-- Card Cek Kepesertaan -->
            <a href="/cek-nik" class="group">
                <div
                    class="bg-[#DBF9E1] h-64 md:h-80 rounded-[40px] flex items-center justify-center p-8 transition-all duration-300 group-hover:shadow-2xl group-hover:-translate-y-2 active:scale-95 border-2 border-transparent group-hover:border-green-200">
                    <p class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight">
                        Cek Kepesertaan<br>Pekerja Rentan
                    </p>
                </div>
            </a>

            <!-- Card Pengajuan Data -->
            <a href="/pengajuan" class="group">
                <div
                    class="bg-[#DBF9E1] h-64 md:h-80 rounded-[40px] flex items-center justify-center p-8 transition-all duration-300 group-hover:shadow-2xl group-hover:-translate-y-2 active:scale-95 border-2 border-transparent group-hover:border-green-200">
                    <p class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight">
                        Pengajuan Data<br>Pekerja Rentan
                    </p>
                </div>
            </a>

        </div>
    </main>
@endsection
