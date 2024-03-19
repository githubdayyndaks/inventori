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
        Schema::create('setting', function (Blueprint $table) {
            $table->bigIncrements('id_setting');
            $table->string('nama_sekolah', 30);
            $table->string('jalan', 50);
            $table->string('kelurahan', 30);
            $table->string('kecamatan', 30);
            $table->string('kabkot', 30);
            $table->string('provinsi', 30);
            $table->string('email', 30);
            $table->text('website');
            $table->integer('npsn')->nullable();
            $table->integer('kodepos')->nullable();
            $table->string('telepon', 20);
            $table->string('path_logo', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
