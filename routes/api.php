<?php 

use App\Models\PesertaBpjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/cek-peserta-bpjs', function (Request $request) {

    if (!preg_match('/^\d{8,16}$/', $request->nik)) {
        return response()->json([
            'status' => false,
            'message' => 'Format NIK tidak valid'
        ], 422);
    }

    $peserta = PesertaBpjs::where('nik', $request->nik)->first();

    if (! $peserta) {
        return response()->json([
            'status' => false,
            'message' => 'Data peserta tidak ditemukan'
        ], 404);
    }

    $peserta["program"] = [
        "jkk" => $peserta["jkk"],
        "jkm" => $peserta["jkm"],
        "jht" => $peserta["jht"]
    ];

    return response()->json([
        'status' => true,
        'data' => $peserta
    ]);
});