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
        Schema::table('pengajuan_peserta_rentan', function (Blueprint $table) {
            $table->string('pekerjaan_1')->after('rw');
            $table->string('pekerjaan_2')->nullable()->after('pekerjaan_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_peserta_rentan', function (Blueprint $table) {
            $table->dropColumn(['pekerjaan_1', 'pekerjaan_2']);
        });
    }
};
