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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim')->unique()->nullable();
            $table->string('prodi')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('semester')->nullable();
            $table->string('nomor')->nullable();
            $table->string('nama_organisasi')->nullable();
            $table->string('jabatan')->default('anggota');
            $table->string('ktm')->nullable();
            $table->string('foto')->nullable();
            $table->string('riwayat_studi')->nullable();
            $table->string('sertif')->nullable();
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('tempat_wawancara')->nullable();
            $table->date('tgl_wawancara')->nullable();
            $table->time('jam_wawancara')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
