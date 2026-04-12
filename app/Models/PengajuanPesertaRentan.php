<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPesertaRentan extends Model
{
    protected $table = 'pengajuan_peserta_rentan';

    protected $fillable = [
        'nik',
        'nik_hash',
        'nama',
        'nomor_telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'provinsi',
        'kode_provinsi',
        'kabupaten',
        'kode_kabupaten',
        'kecamatan',
        'kode_kecamatan',
        'kelurahan',
        'kode_kelurahan',
        'rt',
        'rw',
        'alamat',
        'file_ktp',
        'persetujuan_data',
        'waktu_persetujuan',
    ];

    protected $casts = [
        'nik' => 'encrypted',
        'persetujuan_data' => 'boolean',
        'waktu_persetujuan' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->isDirty('nik')) {
                $model->nik_hash = hash('sha256', $model->nik);
            }
        });
    }
}
