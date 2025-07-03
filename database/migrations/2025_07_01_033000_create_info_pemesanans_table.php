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
    Schema::create('info_pemesanans', function (Blueprint $table) {
        $table->id();
        $table->text('info_pengiriman')->nullable();
        $table->text('info_pembayaran')->nullable();
        $table->text('info_pembatalan')->nullable();
        $table->text('info_harga')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_pemesanans');
    }
};
