@extends('layouts.main')

@section('title', 'Pengajuan Data')

@push('style')
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .filepond--root {
            font-family: 'Outfit', sans-serif;
        }

        .filepond--panel-root {
            background-color: #f8fafc;
            border: 2px dashed #e2e8f0;
        }

        /* Custom green theme for the form elements */
        .form-input-green:focus {
            border-color: #16A34A;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

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
@endpush

@section('content')
    <div class="flex flex-col md:flex-row min-h-screen w-full font-main">
        <!-- Left Section: Image Background -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center relative group overflow-hidden"
            style="background-image: url('{{ asset('img/pengajuan-peserta-bg.webp') }}');">
            <!-- Overlay transisi putih agar menyatu mulus dengan sisi kanan -->
            <div class="absolute inset-y-0 right-0 w-2/3 bg-gradient-to-l from-white via-white/50 to-transparent"></div>
        </div>

        <!-- Mobile Section Hero Image -->
        <div class="md:hidden w-full h-56 bg-cover bg-center relative"
            style="background-image: url('{{ asset('img/pengajuan-peserta-bg.webp') }}');">
            <!-- Overlay transisi putih agar menyatu mulus ke bawah untuk mobile -->
            <div class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-white via-white/60 to-transparent"></div>
        </div>

        <!-- Right Section: Content -->
        <div class="w-full md:w-1/2 flex flex-col bg-white overflow-hidden max-h-screen relative">
            <!-- Inner Header -->
            <header class="p-6 md:p-8 flex justify-between items-center w-full shrink-0 relative z-10">
                <div class="flex flex-col">
                    <img src="{{ asset('img/logo_portal.png') }}" alt="Portal Logo" class="h-10 md:h-16 object-contain object-left">
                    <a href="/"
                        class="flex items-center gap-1 md:gap-2 mt-4 text-gray-400 hover:text-green-600 transition w-fit group">
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
                <div class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="BPJS Logo" class="h-16 md:h-24 object-contain">
                </div>
            </header>

            <!-- Main Body Content: The Form -->
            <main class="flex-grow flex flex-col items-center px-6 md:px-0 py-4 overflow-y-auto w-full relative z-10">
                <div
                    class="w-full max-w-2xl bg-white/95 backdrop-blur rounded-[32px] md:rounded-[40px] shadow-2xl shadow-green-100/50 p-6 md:p-12 space-y-8 border border-green-50 mb-8 mx-auto animate-fade-in">

                    <!-- Header Section -->
                    <div class="text-center space-y-2">
                        <h2 class="text-lg md:text-xl font-bold text-gray-400 tracking-[0.2em] uppercase">Silahkan Isi</h2>
                        <h3 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                            Form Pengajuan Data Pekerja Rentan
                        </h3>
                    </div>

                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <input type="hidden" name="provinsi" value="Papua Tengah">
                        <input type="hidden" name="kode_provinsi" value="94">
                        <input type="hidden" name="kabupaten" value="Mimika">
                        <input type="hidden" name="kode_kabupaten" value="94.04">

                        <!-- Identitas Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-slate-800 border-b pb-2">Data Diri</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="nik" class="block text-sm font-semibold text-slate-600">NIK (Nomor
                                        Induk
                                        Kependudukan)</label>
                                    <input type="text" id="nik" name="nik" maxlength="16"
                                        placeholder="Masukkan 16 digit NIK"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('nik') border-red-500 @enderror"
                                        onkeydown="return isNumberKey(event)" required value="{{ old('nik') }}">
                                    @error('nik')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="nama" class="block text-sm font-semibold text-slate-600">Nama
                                        Lengkap</label>
                                    <input type="text" id="nama" name="nama"
                                        placeholder="Masukkan nama sesuai KTP"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('nama') border-red-500 @enderror"
                                        required value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="nomor_telepon" class="block text-sm font-semibold text-slate-600">Nomor
                                        Telepon</label>
                                    <input type="text" id="nomor_telepon" name="nomor_telepon"
                                        placeholder="Masukkan nomor telepon"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('nomor_telepon') border-red-500 @enderror"
                                        onkeydown="return isNumberKey(event)" required value="{{ old('nomor_telepon') }}">
                                    @error('nomor_telepon')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="tempat_lahir" class="block text-sm font-semibold text-slate-600">Tempat
                                        Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Contoh: Mimika"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('tempat_lahir') border-red-500 @enderror"
                                        required value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="tanggal_lahir" class="block text-sm font-semibold text-slate-600">Tanggal
                                        Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('tanggal_lahir') border-red-500 @enderror"
                                        required value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Section -->
                        <div class="space-y-4 pt-4">
                            <h3 class="text-lg font-bold text-slate-800 border-b pb-2">Alamat Lengkap</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Provinsi Locked -->
                                <div class="space-y-1">
                                    <label class="block text-sm font-semibold text-slate-600">Provinsi</label>
                                    <input type="text" value="Papua Tengah" disabled
                                        class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-slate-500 cursor-not-allowed">
                                </div>

                                <!-- Kabupaten Locked -->
                                <div class="space-y-1">
                                    <label class="block text-sm font-semibold text-slate-600">Kabupaten</label>
                                    <input type="text" value="Mimika" disabled
                                        class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-slate-500 cursor-not-allowed">
                                </div>

                                <!-- Kecamatan Dynamic -->
                                <div class="space-y-1">
                                    <label for="kecamatan"
                                        class="block text-sm font-semibold text-slate-600">Kecamatan</label>
                                    <select id="kecamatan" name="kode_kecamatan"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition bg-white @error('kode_kecamatan') border-red-500 @enderror"
                                        required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    @error('kode_kecamatan')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kelurahan Dynamic -->
                                <div class="space-y-1">
                                    <label for="kelurahan"
                                        class="block text-sm font-semibold text-slate-600">Kelurahan/Desa</label>
                                    <select id="kelurahan" name="kode_kelurahan" disabled
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition bg-white disabled:bg-slate-50 disabled:text-slate-400 @error('kode_kelurahan') border-red-500 @enderror"
                                        required>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    @error('kode_kelurahan')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <input type="hidden" name="kecamatan" id="nama_kecamatan">
                                <input type="hidden" name="kelurahan" id="nama_kelurahan">

                                <!-- RT Manual -->
                                <div class="space-y-1">
                                    <label for="rt" class="block text-sm font-semibold text-slate-600">RT</label>
                                    <input type="text" id="rt" name="rt" placeholder="000"
                                        maxlength="3"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('rt') border-red-500 @enderror"
                                        onkeydown="return isNumberKey(event)" required value="{{ old('rt') }}">
                                    @error('rt')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- RW Manual -->
                                <div class="space-y-1">
                                    <label for="rw" class="block text-sm font-semibold text-slate-600">RW</label>
                                    <input type="text" id="rw" name="rw" placeholder="000"
                                        maxlength="3"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('rw') border-red-500 @enderror"
                                        onkeydown="return isNumberKey(event)" required value="{{ old('rw') }}">
                                    @error('rw')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nama Jalan -->
                                <div class="md:col-span-2 space-y-1">
                                    <label for="alamat" class="block text-sm font-semibold text-slate-600">Nama Jalan /
                                        Detail
                                        Rumah</label>
                                    <textarea id="alamat" name="alamat" rows="2" placeholder="Masukkan nama jalan, nomor rumah, dsb"
                                        class="w-full px-4 py-3 border rounded-xl focus:outline-none form-input-green transition @error('alamat') border-red-500 @enderror" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen Section -->
                        <div class="space-y-4 pt-4">
                            <h3 class="text-lg font-bold text-slate-800 border-b pb-2">Upload Dokumen</h3>
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-600 mb-2">Foto KTP</label>
                                <input type="file" id="file_ktp" name="file_ktp" accept="image/*" required />
                                @error('file_ktp')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Persetujuan Section -->
                        <div class="space-y-4 pt-4">
                            <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                                <div class="flex items-center h-5 mt-1">
                                    <input id="persetujuan_data" name="persetujuan_data" type="checkbox"
                                        class="h-5 w-5 text-[#16A34A] border-slate-300 rounded focus:ring-green-500"
                                        required>
                                </div>
                                <div class="text-sm">
                                    <label for="persetujuan_data" class="font-medium text-slate-700">
                                        Saya menyetujui <button type="button" onclick="openModal()"
                                            class="text-[#16A34A] hover:underline font-bold">Syarat & Ketentuan</button>
                                        pengumpulan dan pemrosesan data pribadi saya sebagaimana diatur dalam kebijakan
                                        privasi.
                                    </label>
                                    @error('persetujuan_data')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" id="submit-btn"
                                class="w-full py-4 md:py-5 text-base md:text-lg rounded-2xl
                               bg-gradient-to-br from-[#28a745] to-[#1e7e34] text-white font-extrabold tracking-wide
                               hover:from-[#218838] hover:to-[#1c7430] hover:shadow-lg hover:shadow-green-300/50 hover:-translate-y-1 transition-all duration-300
                               active:scale-[0.98] flex items-center justify-center space-x-2">
                                <span id="btn-text">Simpan Data Pengajuan</span>
                                <svg id="btn-spinner" class="hidden animate-spin h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
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
            // Allow: backspace, delete, tab, escape, enter
            if ([8, 9, 27, 13, 46].indexOf(charCode) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (charCode === 65 && (evt.ctrlKey === true || evt.metaKey === true)) ||
                // Allow: home, end, left, right
                (charCode >= 35 && charCode <= 40)) {
                return true;
            }
            // Ensure that it is a number and stop the keypress
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

        // Territorial Fetching Logic
        document.addEventListener('DOMContentLoaded', async () => {
            const districtSelect = document.getElementById('kecamatan');
            const villageSelect = document.getElementById('kelurahan');

            // 1. Fetch Kecamatan from Local Backend (Proxy)
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
                alert('Gagal mengambil data kecamatan. Silakan periksa koneksi internet Anda.');
            }

            // 2. Event Listener for Kecamatan Change to Fetch Villages
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

            // Set Kelurahan Name on Change
            villageSelect.addEventListener('change', () => {
                const villageName = villageSelect.options[villageSelect.selectedIndex].text;
                document.getElementById('nama_kelurahan').value = villageName;
            });
        });

        // Loading Animation Logic
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnSpinner = document.getElementById('btn-spinner');

        form.addEventListener('submit', function() {
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

        // Close modal on escape key
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // SweetAlert2 Success Message
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
