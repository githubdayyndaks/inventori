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
        Schema::create('subkategori', function (Blueprint $table) {
            $table->string('kode_subkategori', 6)->primary();
            $table->string('kode_kategori', 6)->index();
            $table->string('nama_subkategori', 30);
            $table->string('jenis', 20);
            $table->string('merk', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkategori');
    }
};
