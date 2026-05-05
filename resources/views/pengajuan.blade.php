@extends('layouts.main')

@section('title', 'Pengajuan Data')

@push('style')
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .form-input-custom {
            width: 100%;
            padding: 0.875rem 1.25rem;
            background-color: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 1.25rem;
            font-weight: 700;
            color: #334155;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            appearance: none;
        }

        .form-input-custom:hover {
            border-color: #e2e8f0;
            background-color: #f1f5f9;
        }

        .form-input-custom:focus {
            background-color: #ffffff;
            border-color: #009245;
            box-shadow: 0 0 0 4px rgba(0, 146, 69, 0.1);
        }

        .form-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
            margin-left: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .input-icon-wrapper {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
            transition: all 0.3s ease;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .group:focus-within .input-icon-wrapper {
            color: #009245;
            transform: translateY(-50%) scale(1.1);
        }

        .step-active {
            background-color: #009245;
            color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 146, 69, 0.2);
        }

        .step-inactive {
            background-color: #ffffff;
            color: #94a3b8;
            border: 1px solid #f1f5f9;
        }

        .step-line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #f1f5f9;
            transform: translateY(-50%);
            z-index: -10;
        }

        /* Custom scrollbar for select dropdowns if needed */
        select.form-input-custom {
            padding-right: 3.5rem;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="relative min-h-screen w-full font-main overflow-hidden bg-white">
        <!-- Main Background Image -->
        <div class="absolute inset-0 z-0">
            <!-- Image on the right -->
            <div class="absolute inset-y-0 right-0 w-full md:w-[70%]">
                <img src="{{ asset('img/pengajuan-peserta-bg.webp') }}" alt="Background"
                    class="w-full h-full object-cover object-center">
            </div>
            <!-- Solid White to Transparent Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-white from-[35%] via-white/90 via-[45%] to-transparent">
            </div>
        </div>

        <!-- Header Logos -->
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

            <!-- Logo Box with Tagline -->
            <div
                class="flex items-center bg-white rounded-2xl md:rounded-3xl px-2 md:px-6 py-1 md:py-2 shadow-md border border-gray-100">
                <img src="{{ asset('img/prima-logo.png') }}" alt="PRIMA" class="h-12 md:h-20 object-contain pr-4">
                <div class="h-8 md:h-12 w-[1px] bg-gray-200 mx-1 md:mx-4"></div>
                <div class="flex items-center gap-3 md:gap-4">
                    <img src="{{ asset('img/ornamen1.png') }}" alt="Ornamen" class="h-14 md:h-16 object-contain">
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="relative z-20 grid grid-cols-1 lg:grid-cols-12 gap-6 px-6 md:px-20 pt-4 pb-12 w-full items-center">
            <!-- Left Side: Content & Features -->
            <div class="lg:col-span-4 flex flex-col justify-center space-y-6">
                <div>
                    <!-- Badge -->
                    <div class="flex items-center gap-2 mb-4">
                        <div class="text-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
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
                        <h2 class="text-xs md:text-sm font-black text-[#009245] tracking-[0.2em] uppercase">Pengajuan Data
                        </h2>
                    </div>

                    <!-- Title -->
                    <h1
                        class="font-poppins text-4xl md:text-6xl font-black text-[#004a2f] leading-[0.9] mb-2 tracking-tight">
                        Form Pengajuan<br><span class="text-[#009245]">Data Pekerja Rentan</span><br>
                    </h1>

                    <p class="font-poppins max-w-md text-gray-600 text-sm md:text-base leading-relaxed mb-4 font-medium">
                        Lengkapi data dengan benar untuk memudahkan proses verifikasi dan perlindungan.
                    </p>

                    <div class="flex items-center mb-4">
                        <div class="h-1.5 w-10 md:w-12 bg-[#009245] rounded-l-full"></div>
                        <div class="h-1.5 w-5 md:w-6 bg-[#c4d600] rounded-r-full"></div>
                    </div>
                </div>

                <!-- Features Cards -->
                <div class="space-y-4 mb-8">
                    <!-- Feature 1: Aman & Terpercaya -->
                    <div
                        class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition-transform hover:translate-x-2">
                        <div
                            class="bg-gradient-to-br from-[#009245] to-[#004a2f] p-3 rounded-xl text-white shadow-lg shadow-green-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#004a2f] leading-tight">Aman & Terpercaya</h4>
                            <p class="text-[11px] text-slate-500 font-medium leading-tight mt-1">Data anda terlindungi
                                sesuai standar keamanan BPJS Ketenagakerjaan.</p>
                        </div>
                    </div>

                    <!-- Feature 2: Cepat & Mudah -->
                    <div
                        class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition-transform hover:translate-x-2">
                        <div class="bg-[#f0f9f4] p-3 rounded-xl text-[#009245]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#004a2f] leading-tight">Cepat & Mudah</h4>
                            <p class="text-[11px] text-slate-500 font-medium leading-tight mt-1">Proses cepat, praktis dan
                                bisa diakses kapan saja.</p>
                        </div>
                    </div>

                    <!-- Feature 3: Untuk Semua -->
                    <div
                        class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition-transform hover:translate-x-2">
                        <div class="bg-[#f0f9f4] p-3 rounded-xl text-[#009245]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#004a2f] leading-tight">Untuk Semua</h4>
                            <p class="text-[11px] text-slate-500 font-medium leading-tight mt-1">Didedikasikan untuk
                                Pekerja Rentan di seluruh Kabupaten Mimika.</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Text -->
                <div class="space-y-3 hidden lg:block">
                    <div class="flex items-center gap-2 text-slate-400">
                        <span class="text-[10px] md:text-[12px] font-black uppercase tracking-widest whitespace-nowrap">© 2026 BPJS Ketenagakerjaan Papua Mimika</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form Card -->
            <div class="lg:col-span-5">
                <div class="bg-white border border-gray-100 rounded-[32px] shadow-2xl overflow-hidden animate-fade-in">
                    <!-- Stepper Bar -->
                    <div class="bg-slate-50 p-4 border-b border-gray-100">
                        <div class="flex items-center justify-between max-w-lg mx-auto">
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500 step-active">
                                    1</div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Data
                                    Diri</span>
                            </div>
                            <div class="flex-grow h-[2px] mx-2 bg-slate-200 mb-6"></div>
                            <!-- Step 2 -->
                            <div class="flex flex-col items-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500 step-inactive">
                                    2</div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Alamat</span>
                            </div>
                            <div class="flex-grow h-[2px] mx-2 bg-slate-200 mb-6"></div>
                            <!-- Step 3 -->
                            <div class="flex flex-col items-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500 step-inactive">
                                    3</div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Dokumen</span>
                            </div>
                            <div class="flex-grow h-[2px] mx-2 bg-slate-200 mb-6"></div>
                            <!-- Step 4 -->
                            <div class="flex flex-col items-center gap-2">
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm transition-all duration-500 step-inactive">
                                    4</div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Review</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 space-y-6">
                        <div>
                            <h2 class="text-2xl font-black text-[#004a2f] tracking-tight">Data Diri</h2>
                            <p class="text-slate-500 text-sm font-medium mt-0.5">Lengkapi informasi pribadi Anda dengan
                                benar.</p>
                        </div>

                        <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                            id="multi-step-form" class="space-y-6">
                            @csrf
                            <input type="hidden" name="provinsi" value="Papua Tengah">
                            <input type="hidden" name="kode_provinsi" value="94">
                            <input type="hidden" name="kabupaten" value="Mimika">
                            <input type="hidden" name="kode_kabupaten" value="94.04">

                            <!-- Step 1: Data Diri -->
                            <div class="step-content" id="step-1">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- NIK -->
                                    <div class="space-y-1">
                                        <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                                        <div class="relative group">
                                            <input type="text" id="nik" name="nik" maxlength="16"
                                                placeholder="Masukkan 16 digit NIK" class="form-input-custom pr-14"
                                                onkeydown="return isNumberKey(event)" required autocomplete="off"
                                                value="{{ old('nik') }}">
                                            <div class="input-icon-wrapper">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('nik')
                                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nama -->
                                    <div class="space-y-1">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <div class="relative">
                                            <input type="text" id="nama" name="nama"
                                                placeholder="Masukkan nama sesuai KTP" class="form-input-custom" required
                                                value="{{ old('nama') }}">
                                        </div>
                                        @error('nama')
                                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Nomor Telepon -->
                                    <div class="space-y-1">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                        <div class="relative group">
                                            <input type="text" id="nomor_telepon" name="nomor_telepon"
                                                placeholder="Masukkan nomor telepon" class="form-input-custom pr-14"
                                                onkeydown="return isNumberKey(event)" required
                                                value="{{ old('nomor_telepon') }}">
                                            <div class="input-icon-wrapper">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('nomor_telepon')
                                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Tempat Lahir -->
                                    <div class="space-y-1">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <div class="relative group">
                                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                                placeholder="Contoh: Mimika" class="form-input-custom pr-14" required
                                                value="{{ old('tempat_lahir') }}">
                                            <div class="input-icon-wrapper">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('tempat_lahir')
                                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="space-y-1">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <div class="relative group">
                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                                class="form-input-custom pr-14" required
                                                value="{{ old('tanggal_lahir') }}">
                                            <div class="input-icon-wrapper pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('tanggal_lahir')
                                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="space-y-1">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <div class="relative group">
                                            <select id="jenis_kelamin" name="jenis_kelamin"
                                                class="form-input-custom appearance-none bg-white" required>
                                                <option value="">Pilih jenis kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                            <div class="input-icon-wrapper pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Pekerjaan -->
                                    <div class="space-y-4">
                                        <label for="pekerjaan_1" class="form-label">Status Pekerjaan 1 (Utama)</label>
                                        <div class="relative group">
                                            <select id="pekerjaan_1" name="pekerjaan_1" class="form-input-custom"
                                                required>
                                                <option value="">Pilih status pekerjaan 1</option>
                                                @foreach ($pekerjaans as $p)
                                                    <option value="{{ $p->nama }}"
                                                        {{ old('pekerjaan_1') == $p->nama ? 'selected' : '' }}>
                                                        {{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-icon-wrapper pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <label for="pekerjaan_2" class="form-label">Status Pekerjaan 2 (Tambahan)</label>
                                        <div class="relative group">
                                            <select id="pekerjaan_2" name="pekerjaan_2" class="form-input-custom"
                                                required>
                                                <option value="">Pilih status pekerjaan 2</option>
                                                @foreach ($pekerjaans as $p)
                                                    <option value="{{ $p->nama }}"
                                                        {{ old('pekerjaan_2') == $p->nama ? 'selected' : '' }}>
                                                        {{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-icon-wrapper pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Alamat -->
                            <div class="step-content hidden" id="step-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-1">
                                        <label class="form-label">Provinsi</label>
                                        <input type="text" value="Papua Tengah" disabled
                                            class="form-input-custom bg-slate-50/80 text-slate-400 cursor-not-allowed font-semibold border-slate-100">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="form-label">Kabupaten</label>
                                        <input type="text" value="Mimika" disabled
                                            class="form-input-custom bg-slate-50/80 text-slate-400 cursor-not-allowed font-semibold border-slate-100">
                                    </div>
                                    <div class="space-y-1">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <div class="relative group">
                                            <select id="kecamatan" name="kode_kecamatan"
                                                class="form-input-custom appearance-none bg-white" required>
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                            <div class="input-icon-wrapper pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-1">
                                        <label for="kelurahan" class="form-label">Kelurahan/Desa</label>
                                        <div class="relative group">
                                            <select id="kelurahan" name="kode_kelurahan" disabled
                                                class="form-input-custom appearance-none bg-white disabled:bg-slate-50 disabled:text-slate-300"
                                                required>
                                                <option value="">Pilih Kelurahan</option>
                                            </select>
                                            <div class="input-icon-wrapper pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="kecamatan" id="nama_kecamatan">
                                    <input type="hidden" name="kelurahan" id="nama_kelurahan">

                                    <div class="space-y-1">
                                        <label for="rt" class="form-label">RT</label>
                                        <input type="text" id="rt" name="rt" placeholder="000"
                                            maxlength="3" class="form-input-custom"
                                            onkeydown="return isNumberKey(event)" required value="{{ old('rt') }}">
                                    </div>
                                    <div class="space-y-1">
                                        <label for="rw" class="form-label">RW</label>
                                        <input type="text" id="rw" name="rw" placeholder="000"
                                            maxlength="3" class="form-input-custom"
                                            onkeydown="return isNumberKey(event)" required value="{{ old('rw') }}">
                                    </div>
                                    <div class="md:col-span-2 space-y-1">
                                        <label for="alamat" class="form-label">Nama Jalan / Detail Rumah</label>
                                        <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan nama jalan, nomor rumah, dsb"
                                            class="form-input-custom" required>{{ old('alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Dokumen -->
                            <div class="step-content hidden" id="step-3">
                                <div class="space-y-6">
                                    <div
                                        class="p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[32px] text-center space-y-4">
                                        <div
                                            class="mx-auto w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-slate-400 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-800">Upload Foto KTP</h4>
                                            <p class="text-sm text-slate-500">Pastikan foto jelas dan tidak buram (Maks.
                                                15MB)</p>
                                        </div>
                                        <input type="file" id="file_ktp" name="file_ktp" accept="image/*"
                                            required />
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Review -->
                            <div class="step-content hidden" id="step-4">
                                <div class="space-y-6">
                                    <div class="p-6 bg-slate-50 rounded-[32px] border border-slate-200 space-y-4">
                                        <h4 class="font-black text-slate-800 border-b pb-2">Ringkasan Data</h4>
                                        <div class="grid grid-cols-2 gap-y-3 text-sm">
                                            <span class="text-slate-500">NIK:</span> <span id="review-nik"
                                                class="font-bold text-slate-800">-</span>
                                            <span class="text-slate-500">Nama:</span> <span id="review-nama"
                                                class="font-bold text-slate-800">-</span>
                                            <span class="text-slate-500">Telepon:</span> <span id="review-telepon"
                                                class="font-bold text-slate-800">-</span>
                                            <span class="text-slate-500">Pekerjaan 1:</span> <span id="review-pekerjaan-1"
                                                class="font-bold text-slate-800">-</span>
                                            <span class="text-slate-500">Pekerjaan 2:</span> <span id="review-pekerjaan-2"
                                                class="font-bold text-slate-800">-</span>
                                            <span class="text-slate-500">Alamat:</span> <span id="review-alamat"
                                                class="font-bold text-slate-800">-</span>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start gap-4 p-5 bg-orange-50 rounded-2xl border border-orange-100">
                                        <input id="persetujuan_data" name="persetujuan_data" type="checkbox"
                                            class="h-6 w-6 text-green-600 border-slate-300 rounded-lg focus:ring-green-500 mt-1"
                                            required>
                                        <label for="persetujuan_data" class="text-sm font-medium text-slate-700">
                                            Saya menyetujui <button type="button" onclick="openModal()"
                                                class="text-green-600 hover:underline font-black">Syarat &
                                                Ketentuan</button>
                                            pengumpulan dan pemrosesan data pribadi saya.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Warning Box (Always visible at bottom of content) -->
                            <div
                                class="p-4 bg-green-50 rounded-2xl border border-green-100 flex items-start gap-4 shadow-sm">
                                <div class="p-2 bg-white text-green-500 rounded-xl shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="space-y-0">
                                    <p class="text-xs font-black text-green-700">Pastikan data yang Anda masukkan sudah
                                        benar.</p>
                                    <p class="text-[10px] text-green-600/80 font-medium leading-tight">Data yang lengkap
                                        dan valid akan mempercepat proses verifikasi.</p>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex items-center justify-between pt-4">
                                <button type="button" id="prev-btn"
                                    class="hidden px-4 py-2 md:px-6 md:py-3 text-slate-400 font-black hover:text-slate-600 transition-colors text-xs md:text-sm">
                                    Kembali
                                </button>
                                <div class="flex-grow"></div>
                                <button type="button" id="next-btn"
                                    class="group bg-gradient-to-br from-[#16A34A] to-[#004a2f] text-white px-6 py-3 md:px-10 md:py-4 rounded-xl md:rounded-2xl font-black text-base md:text-lg flex items-center gap-3 md:gap-4 hover:shadow-2xl hover:shadow-green-900/30 hover:-translate-y-1 transition-all duration-500 shadow-lg">
                                    <span id="next-btn-text">Lanjutkan</span>
                                    <div
                                        class="w-8 h-8 md:w-10 md:h-10 bg-white/20 rounded-lg md:rounded-xl flex items-center justify-center group-hover:translate-x-1 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </div>
                                </button>
                                <button type="submit" id="submit-btn"
                                    class="hidden group bg-gradient-to-br from-[#16A34A] to-[#004a2f] text-white px-6 py-3 md:px-10 md:py-4 rounded-xl md:rounded-2xl font-black text-base md:text-lg flex items-center gap-3 md:gap-4 hover:shadow-2xl hover:shadow-green-900/30 hover:-translate-y-1 transition-all duration-500 shadow-lg">
                                    <span id="btn-text">Simpan Data</span>
                                    <div id="btn-spinner"
                                        class="hidden animate-spin h-4 w-4 md:h-5 md:w-5 border-2 border-white/30 border-t-white rounded-full">
                                    </div>
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-white/20 rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Footer Text -->
                <div class="space-y-3 mt-6 lg:mt-8 flex justify-center lg:justify-end lg:hidden">
                    <div class="flex items-center justify-center gap-2 text-slate-400 bg-white/80 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-sm border border-gray-100 z-10 relative w-auto inline-flex mx-auto">
                        <span class="text-[9px] md:text-[12px] font-black uppercase tracking-widest whitespace-nowrap">© 2026 BPJS Ketenagakerjaan Papua Mimika</span>
                    </div>
                </div>
            </div>
        </main>

        <!-- Tribal motif sweep -->
        <div class="absolute bottom-0 right-0 z-0 pointer-events-none max-w-[400px]">
            <img src="{{ asset('img/tribal_bpjstk.png') }}" alt="Tribal" class="w-full object-contain">
        </div>
    </div>

    <!-- Modal Syarat & Ketentuan -->
    <div id="termsModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-2xl font-bold text-slate-900 mb-6" id="modal-title">
                                Syarat & Ketentuan Pengumpulan Data
                            </h3>
                            <div
                                class="mt-4 space-y-4 text-slate-600 text-md leading-relaxed overflow-y-auto max-h-[60vh] pr-2 text-justify">
                                <p class="font-bold text-slate-800">1. Pernyataan Persetujuan</p>
                                <p>Dengan mengajukan permohonan ini, Anda memberikan izin yang sadar dan sukarela kepada
                                    BPJS
                                    Ketenagakerjaan untuk mengumpulkan, menyimpan, dan memproses data pribadi Anda sesuai
                                    dengan Undang-Undang Perlindungan Data Pribadi (UU PDP) yang berlaku di Republik
                                    Indonesia.</p>

                                <p class="font-bold text-slate-800">2. Tujuan Pengumpulan Data</p>
                                <p>Data pribadi Anda, termasuk Nomor Induk Kependudukan (NIK), alamat, nomor telepon, dan
                                    foto
                                    KTP, akan digunakan eksklusif untuk keperluan administrasi pendaftaran kepesertaan
                                    BPJS Ketenagakerjaan bagi Pekerja Rentan.</p>

                                <p class="font-bold text-slate-800">3. Keamanan Data</p>
                                <p>Kami berkomitmen untuk menjaga keamanan data Anda. Data NIK Anda akan disimpan dalam
                                    bentuk
                                    terenkripsi (encrypted) di database kami. Foto KTP akan disimpan secara aman di
                                    direktori privat yang tidak dapat diakses oleh publik secara langsung.</p>

                                <p class="font-bold text-slate-800">4. Akurasi Data</p>
                                <p>Anda bertanggung jawab penuh atas keakuratan dan kebenaran data yang dikirimkan.
                                    Pemberian
                                    data palsu dapat berakibat pada pembatalan pengajuan dan konsekuensi hukum sesuai
                                    dengan perundang-undangan yang berlaku.</p>

                                <p class="font-bold text-slate-800">5. Penyimpanan Data</p>
                                <p>Kami akan mencatat waktu dan detail persetujuan Anda sebagai bukti sah bahwa Anda telah
                                    menyetujui persyaratan ini pada saat pengiriman data.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse rounded-b-3xl">
                    <button type="button" onclick="closeModal()"
                        class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-[#16A34A] text-base font-bold text-white hover:bg-[#15803d] focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        Saya Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        // Validation for numeric input only
        function isNumberKey(evt) {
            const charCode = (evt.which) ? evt.which : evt.keyCode;
            if ([8, 9, 27, 13, 46].indexOf(charCode) !== -1 ||
                (charCode === 65 && (evt.ctrlKey === true || evt.metaKey === true)) ||
                (charCode >= 35 && charCode <= 40)) {
                return true;
            }
            if ((evt.shiftKey || (charCode < 48 || charCode > 57)) && (charCode < 96 || charCode > 105)) {
                evt.preventDefault();
                return false;
            }
            return true;
        }

        // Initialize FilePond
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType,
            FilePondPluginFileValidateSize
        );

        const inputElement = document.querySelector('#file_ktp');
        const pond = FilePond.create(inputElement, {
            labelIdle: 'Seret & letakkan file atau <span class="filepond--label-action">Telusuri</span>',
            maxFileSize: '15MB',
            acceptedFileTypes: ['image/png', 'image/jpeg'],
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
            storeAsFile: true,
            required: true,
        });

        // Multi-step Logic
        let currentStep = 1;
        const totalSteps = 4;
        const form = document.getElementById('multi-step-form');
        const nextBtn = document.getElementById('next-btn');
        const prevBtn = document.getElementById('prev-btn');
        const submitBtn = document.getElementById('submit-btn');
        const btnSpinner = document.getElementById('btn-spinner');
        const btnText = document.getElementById('btn-text');

        function updateStepper() {
            // Update visual steps
            document.querySelectorAll('.flex-col.items-center div').forEach((el, index) => {
                if (index + 1 <= currentStep) {
                    el.classList.remove('step-inactive');
                    el.classList.add('step-active');
                } else {
                    el.classList.remove('step-active');
                    el.classList.add('step-inactive');
                }
            });

            // Update Card Title
            const titles = ["Data Diri", "Alamat Lengkap", "Upload Dokumen", "Review & Konfirmasi"];
            const subtitles = [
                "Lengkapi informasi pribadi Anda dengan benar.",
                "Masukkan detail alamat tempat tinggal saat ini.",
                "Lampirkan dokumen pendukung yang diperlukan.",
                "Pastikan semua data sudah benar sebelum mengirim."
            ];
            document.querySelector('h2.text-2xl').textContent = titles[currentStep - 1];
            document.querySelector('p.text-slate-500').textContent = subtitles[currentStep - 1];
        }

        nextBtn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    document.getElementById(`step-${currentStep}`).classList.add('hidden');
                    currentStep++;
                    document.getElementById(`step-${currentStep}`).classList.remove('hidden');

                    if (currentStep === totalSteps) {
                        nextBtn.classList.add('hidden');
                        submitBtn.classList.remove('hidden');
                        updateReviewData();
                    }

                    prevBtn.classList.remove('hidden');
                    updateStepper();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            } else {
                Swal.fire({
                    title: 'Data Belum Lengkap',
                    text: 'Silakan isi semua bidang yang wajib diisi.',
                    icon: 'warning',
                    confirmButtonColor: '#16A34A'
                });
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                document.getElementById(`step-${currentStep}`).classList.add('hidden');
                currentStep--;
                document.getElementById(`step-${currentStep}`).classList.remove('hidden');

                if (currentStep < totalSteps) {
                    nextBtn.classList.remove('hidden');
                    submitBtn.classList.add('hidden');
                }

                if (currentStep === 1) prevBtn.classList.add('hidden');
                updateStepper();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        function validateStep(step) {
            const stepEl = document.getElementById(`step-${step}`);
            const inputs = stepEl.querySelectorAll('[required]');
            let valid = true;

            inputs.forEach(input => {
                if (input.tagName === 'INPUT' || input.tagName === 'SELECT' || input.tagName === 'TEXTAREA') {
                    if (!input.value || (input.type === 'checkbox' && !input.checked)) {
                        valid = false;
                        input.classList.add('border-red-500');
                    } else {
                        input.classList.remove('border-red-500');
                    }
                }
            });

            // Special check for FilePond if in step 3
            if (step === 3 && pond.getFiles().length === 0) {
                valid = false;
                document.querySelector('.filepond--panel-root').classList.add('border-red-500');
            } else if (step === 3) {
                document.querySelector('.filepond--panel-root').classList.remove('border-red-500');
            }

            return valid;
        }

        function updateReviewData() {
            document.getElementById('review-nik').textContent = document.getElementById('nik').value;
            document.getElementById('review-nama').textContent = document.getElementById('nama').value;
            document.getElementById('review-telepon').textContent = document.getElementById('nomor_telepon').value;
            document.getElementById('review-pekerjaan-1').textContent = document.getElementById('pekerjaan_1').value;
            document.getElementById('review-pekerjaan-2').textContent = document.getElementById('pekerjaan_2').value;

            const alamat =
                `${document.getElementById('alamat').value}, RT ${document.getElementById('rt').value}/RW ${document.getElementById('rw').value}, ${document.getElementById('nama_kelurahan').value}, ${document.getElementById('nama_kecamatan').value}`;
            document.getElementById('review-alamat').textContent = alamat;
        }

        // Territorial Fetching Logic
        document.addEventListener('DOMContentLoaded', async () => {
            const districtSelect = document.getElementById('kecamatan');
            const villageSelect = document.getElementById('kelurahan');

            try {
                const response = await fetch('/api/wilayah/kecamatan', {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await response.json();
                data.data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.code;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Gagal mengambil data kecamatan:', error);
            }

            districtSelect.addEventListener('change', async () => {
                const districtId = districtSelect.value;
                const districtName = districtSelect.options[districtSelect.selectedIndex].text;
                document.getElementById('nama_kecamatan').value = districtName;
                villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                villageSelect.disabled = true;
                if (districtId) {
                    try {
                        const response = await fetch(`/api/wilayah/kelurahan/${districtId}`, {
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        const data = await response.json();
                        data.data.forEach(village => {
                            const option = document.createElement('option');
                            option.value = village.code;
                            option.textContent = village.name;
                            villageSelect.appendChild(option);
                        });
                        villageSelect.disabled = false;
                    } catch (error) {
                        console.error('Gagal mengambil data kelurahan:', error);
                    }
                }
            });

            villageSelect.addEventListener('change', () => {
                const villageName = villageSelect.options[villageSelect.selectedIndex].text;
                document.getElementById('nama_kelurahan').value = villageName;
            });
        });

        // Loading Animation Logic
        form.addEventListener('submit', function(e) {
            if (form.checkValidity()) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
                btnText.textContent = 'Memproses...';
                btnSpinner.classList.remove('hidden');
            }
        });

        // Modal Functions
        function openModal() {
            const modal = document.getElementById('termsModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('termsModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#16A34A',
                customClass: {
                    popup: 'rounded-[30px]',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold'
                }
            });
        @endif
    </script>
@endpush
