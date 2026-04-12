<?php

use App\Models\PesertaBpjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\PengajuanPekerjaRentanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek-nik', function () {
    return view('cek-nik');
});

Route::get('/pengajuan', [PengajuanPekerjaRentanController::class, 'index']);
Route::post('/pengajuan', [PengajuanPekerjaRentanController::class, 'store'])->name('pengajuan.store');
Route::get('/pengajuan/file/{file}', [PengajuanPekerjaRentanController::class, 'showKtp'])->name('pengajuan.file')->middleware(['auth', 'admin', 'signed']);

// API Wilayah (Backend Proxy)
Route::get('/api/wilayah/kecamatan', [WilayahController::class, 'getDistricts']);
Route::get('/api/wilayah/kelurahan/{districtCode}', [WilayahController::class, 'getVillages']);

Route::post('/cek-peserta-bpjs', function (Request $request) {
    $peserta = PesertaBpjs::where('nik', $request->nik)->first();

    if (!$peserta) {
        return response()->json([
            'status' => false,
            'message' => 'Data peserta tidak ditemukan',
        ], 404);
    }

    $peserta["program"] = [
        "jkk" => $peserta["jkk"],
        "jkm" => $peserta["jkm"],
        "jht" => $peserta["jht"]
    ];

    dd($peserta);

    return response()->json([
        'status' => true,
        'data' => $peserta,
    ]);
})->name('cek.peserta.bpjs');

// Route::view('/cek-bpjs', 'cek-bpjs');
