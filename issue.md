Kamu adalah seorang Frontend Web Developer profesional. Tugasmu adalah membuat sebuah halaman form menggunakan Laravel Blade template engine dengan styling Tailwind CSS dan logika interaksi Vanilla Javascript.

Buatkan sebuah halaman form **Pengajuan Data** dengan spesifikasi yang sangat detail di bawah ini:

### 1. Struktur Input Data Diri
Buat form input dengan field berikut (gunakan class Tailwind agar tampilan rapi, responsif, dan modern):
- **NIK:** Input berupa angka (type text, max-length 16 karakter).
- **Nama Lengkap:** Input teks.
- **Tempat Lahir:** Input teks.
- **Tanggal Lahir:** Input tanggal (type date).

### 2. Struktur Input Alamat & Integrasi API (wilayah.id)
Buat bagian alamat dengan aturan logika yang sangat ketat:
- **Provinsi (Read-Only):** Buat input teks atau select box yang **di-disable** (tidak bisa diubah). Set nilainya atau value default ke **"Papua Tengah"**. *(Catatan: Kode wilayah Papua Tengah biasanya `94`)*.
- **Kabupaten/Kota (Read-Only):** Buat input teks atau select box yang **di-disable** (tidak bisa diubah). Set nilainya atau value default ke **"Mimika"**. *(Catatan: Kode wilayah Mimika biasanya `94.04`)*.
- **Kecamatan (Dinamic Select):** Buat elemen `<select>`. Saat halaman dimuat, panggil Fetch API ke endpoint `https://wilayah.id/api/districts/94.04.json` (ID Kab Mimika) untuk mendapatkan daftar kecamatan. Masukkan hasilnya sebagai opsi `<option>` ke dalam select box ini.
- **Kelurahan/Desa (Dinamic Select):** Buat elemen `<select>`. Secara default, select ini harus **disabled**. Saat user *memilih* Kecamatan, ambil data (Fetch) kelurahannya dari API `https://wilayah.id/api/villages/{id_kecamatan}.json`. Setelah data didapat, hidupkan (enable) select box ini dan isi dengan opsi `<option>` kelurahan.
- **RT/RW:** Buat input teks manual. Bisa dipisah 2 input (RT dan RW tersendiri) atau 1 input teks biasa.
- **Nama Jalan / Detail Alamat:** Buat elemen `<textarea>` untuk alamat detail.

### 3. Upload KTP dengan FilePond
Di paling bawah form, tambahkan fitur upload foto KTP:
- **WAJIB** menggunakan library **FilePond** (jangan gunakan input file HTML bawaan biasa untuk UI-nya).
- Sertakan link CDN CSS dan JS untuk FilePond (termasuk plugin FilePond seperti: `FilePondPluginImagePreview`, `FilePondPluginFileValidateType`, `FilePondPluginFileValidateSize`).
- Inisiasi (initialize) input file tersebut menjadi FilePond via Javascript.
- Batasi tipe file yang bisa diupload hanya gambar (JPEG, PNG) dan maksimal ukuran 2MB.

### 4. Desain dan Responsivitas (UI/UX)
- Form ini harus mengikuti gaya desain dari `welcome.blade.php`. Gunakan kartu form bersudut tumpul besar (`rounded-2xl` atau `rounded-[40px]`), bayangan besar (`shadow-2xl`), dan pertahankan tema warna.
- Layout halaman harus dibungkus secara terpusat. Gunakan struktur `<main class="flex-grow flex items-center justify-center p-6">` untuk menaruh kartu form di tengah layar.
- Untuk tombol "Simpan Data", dan elemen interaktif lainnya, terapkan efek hover membesar/bergeser dan warna background bertema hijau (seperti `bg-[#DBF9E1]`, `bg-green-600` atau setelan primary hijau yang konsisten). JANGAN menggunakan warna indigo/biru.
- Gunakan Tailwind classes karena project ini sudah terhubung dengan Tailwind. Tidak perlu CDN Tailwind di dalam file ini karena akan mewarisi layout utama.
### Output yang Diminta:
Berikan *SATU* blok kode dengan format `.blade.php`. Kode ini harus meng-extend layout utama dan menempatkan komponen ke tempat yang semestinya:
- Mulai file dengan `@extends('layouts.main')` dan tetapkan judul halaman (`@section('title', 'Pengajuan Data')`).
- Bagian konten UI ditaruh di dalam `@section('content') ... @endsection`.
- Bagian `<script>` (termasuk inisiasi CDN JS FilePond dan Script API) dan bagian `<style>`/CDN CSS FilePond ditaruh di dalam `@push('script') ... @endpush` atau `@push('style') ... @endpush`.
Jangan beri penjelasan panjang lebar, langsung berikan kode `.blade.php`-nya saja!
