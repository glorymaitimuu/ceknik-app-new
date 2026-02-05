<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaBpjs extends Model
{
    protected $table = 'peserta_bpjs';

    protected $fillable = [
        'nik',
        'kpj',
        'nama',
        'tgl_lahir',
        'no_handphone',
        'jht',
        'jkk',
        'jkm',
        'jenis_pekerjaan',
        'tgl_kepesertaan',
        'tgl_berakhir',
        'masa_grace',
    ];
}
