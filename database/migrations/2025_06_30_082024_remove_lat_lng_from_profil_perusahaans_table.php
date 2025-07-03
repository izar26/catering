<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_perusahaans', function (Blueprint $table) {
            // Hapus kolom latitude dan longitude
            $table->dropColumn(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::table('profil_perusahaans', function (Blueprint $table) {
            // Jika ingin rollback, buat kembali kolomnya
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 11, 7)->nullable();
        });
    }
};