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
        Schema::create('peserta_bpjs', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 100)->unique();
            $table->string('kpj', 100)->nullable();
            $table->string('nama', 100);
            $table->date('tgl_lahir')->nullable();
            $table->string('no_handphone', 20)->nullable();

            $table->boolean('jht')->default(0);
            $table->boolean('jkk')->default(0);
            $table->boolean('jkm')->default(0);

            $table->string('jenis_pekerjaan', 100)->nullable();

            $table->date('tgl_kepesertaan')->nullable();
            $table->date('tgl_berakhir')->nullable();
            $table->date('masa_grace')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_bpjs');
    }
};
