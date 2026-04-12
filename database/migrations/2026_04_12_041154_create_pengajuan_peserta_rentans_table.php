<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_peserta_rentan', function (Blueprint $table) {
            $table->id();
            $table->text('nik');
            $table->string('nik_hash')->unique();
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('provinsi');
            $table->string('kode_provinsi');
            $table->string('kabupaten');
            $table->string('kode_kabupaten');
            $table->string('kecamatan');
            $table->string('kode_kecamatan');
            $table->string('kelurahan');
            $table->string('kode_kelurahan');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->text('alamat')->nullable();
            $table->string('file_ktp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_peserta_rentan');
    }
};
