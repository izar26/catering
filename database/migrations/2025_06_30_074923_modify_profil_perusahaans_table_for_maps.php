<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // GANTI DENGAN NAMA TABEL YANG BENAR
        Schema::table('profil_perusahaans', function (Blueprint $table) {
            // Baris ini mungkin akan error jika kolom peta_embed tidak ada,
            // jika error, cukup beri komentar atau hapus baris ini.
            try {
                 $table->dropColumn('peta_embed');
            } catch (\Exception $e) {
                // Abaikan error jika kolom tidak ada
            }

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 11, 7)->nullable();
        });
    }

    public function down(): void
    {
        // GANTI DENGAN NAMA TABEL YANG BENAR
        Schema::table('profil_perusahaans', function (Blueprint $table) {
            $table->text('peta_embed')->nullable();
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};