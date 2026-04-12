<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPesertaRentan;
use Illuminate\Support\Facades\Storage;

class PengajuanPekerjaRentanController extends Controller
{
    public function index() {
        return view('pengajuan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => [
                'required',
                'numeric',
                'digits:16',
                function ($attribute, $value, $fail) {
                    $hash = hash('sha256', $value);
                    if (PengajuanPesertaRentan::where('nik_hash', $hash)->exists()) {
                        $fail('NIK ini sudah pernah terdaftar dalam sistem pengajuan.');
                    }
                }
            ],
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|numeric',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'provinsi' => 'required|string',
            'kode_provinsi' => 'required',
            'kabupaten' => 'required|string',
            'kode_kabupaten' => 'required',
            'kecamatan' => 'required|string',
            'kode_kecamatan' => 'required',
            'kelurahan' => 'required|string',
            'kode_kelurahan' => 'required',
            'rt' => 'required|numeric|digits:3',
            'rw' => 'required|numeric|digits:3',
            'alamat' => 'required|string',
            'file_ktp' => 'required|image|max:10240',
            'persetujuan_data' => 'accepted',
        ], [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute harus berupa angka.',
            'digits' => ':attribute harus berukuran :digits digit.',
            'unique' => ':attribute sudah terdaftar.',
            'date' => ':attribute bukan format tanggal yang valid.',
            'image' => ':attribute harus berupa gambar.',
            'max' => ':attribute tidak boleh lebih dari :max kilobita.',
            'persetujuan_data.accepted' => 'Anda harus menyetujui syarat dan ketentuan untuk melanjutkan.',
        ], [
            'nik' => 'NIK',
            'nik_hash' => 'NIK',
            'nama' => 'Nama Lengkap',
            'nomor_telepon' => 'Nomor Telepon',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'provinsi' => 'Provinsi',
            'kode_provinsi' => 'Kode Provinsi',
            'kabupaten' => 'Kabupaten',
            'kode_kabupaten' => 'Kode Kabupaten',
            'kecamatan' => 'Kecamatan',
            'kode_kecamatan' => 'Kode Kecamatan',
            'kelurahan' => 'Kelurahan',
            'kode_kelurahan' => 'Kode Kelurahan',
            'rt' => 'RT',
            'rw' => 'RW',
            'alamat' => 'Detail Alamat',
            'file_ktp' => 'Foto KTP',
            'persetujuan_data' => 'Persetujuan Data Pribadi',
        ]);

        $data = $request->all();
        $data['persetujuan_data'] = $request->boolean('persetujuan_data');
        $data['waktu_persetujuan'] = now();

        if ($request->hasFile('file_ktp')) {
            // Simpan di disk 'local' agar tidak bisa diakses publik secara langsung
            $path = $request->file('file_ktp')->store('uploads/ktp', 'local');
            $data['file_ktp'] = $path;
        }

        PengajuanPesertaRentan::create($data);

        return redirect()->back()->with('success', 'Pengajuan Anda telah kami terima! Data akan segera diproses oleh tim kami, dan Anda akan dihubungi melalui nomor telepon yang terdaftar untuk informasi lebih lanjut.');
    }

    public function showKtp($file)
    {
        $path = 'uploads/ktp/' . $file;

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return response()->file(storage_path('app/' . $path));
    }
}
