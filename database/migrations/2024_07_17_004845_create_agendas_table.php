<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('nama_organisasi');
            $table->string('slug')->unique();
            $table->longText('keterangan');
            $table->date('tanggal_mulai');
            $table->string('tempat_kegiatan');
            $table->string('gambar')->nullable();
            $table->string('proposal')->nullable();
            $table->string('lpj')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
};
