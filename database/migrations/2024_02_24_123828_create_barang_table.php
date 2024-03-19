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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang', 6)->primary();
            $table->string('kode_ruangan', 6)->index();
            $table->string('kode_kategori', 6)->index();
            $table->string('kode_subkategori', 6)->index();
            $table->unsignedBigInteger('id_user')->index(); // Menggunakan unsignedBigInteger untuk id
            $table->string('nama_barang', 30);
            $table->string('merk', 20);
            $table->string('jenis', 20);
            $table->string('bahan', 20);
            $table->string('ukuran', 20);
            $table->enum('kondisi', ['baik', 'sedang di perbaiki', 'rusak'])->default('baik');
            $table->integer('total_item')->nullable(); // Menghilangkan 11 pada integer
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
