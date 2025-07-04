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
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kategori_id')->index('produks_kategori_id_foreign');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('tipe')->default('satuan');
            $table->boolean('is_unggulan')->default(false);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 13);
            $table->string('gambar')->nullable();
            $table->text('pesan_wa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
