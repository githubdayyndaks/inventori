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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjam');
            $table->string('kode_barang', 6)->index();
            $table->unsignedBigInteger('id_user')->index();
            $table->timestamp('tanggal_pinjam');
            $table->timestamp('tanggal_pengembalian')->nullable()->default(null);
            $table->string('nama_barang', 30);
            $table->string('nama_peminjam', 20);
            $table->string('merk', 20);
            $table->string('bahan', 20);
            $table->string('ukuran', 20);
            $table->enum('kondisi', ['baik', 'sedang di perbaiki', 'rusak'])->default('baik');
            $table->text('keterangan');
            $table->integer('jumlah_barang');
            $table->enum('status', ['dipinjam', 'proses', 'ditolak'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
