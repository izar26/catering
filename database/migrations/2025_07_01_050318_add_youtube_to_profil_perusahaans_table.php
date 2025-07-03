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
    Schema::table('profil_perusahaans', function (Blueprint $table) {
        // Menambahkan kolom youtube setelah kolom tiktok
        $table->string('youtube')->nullable()->after('tiktok');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_perusahaans', function (Blueprint $table) {
            //
        });
    }
};
