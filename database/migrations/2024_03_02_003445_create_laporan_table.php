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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_laporan_status')->default(1);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kendaraan');
            $table->string('no_laporan');
            $table->date('tanggal_laporan');
            $table->date('tanggal_hilang');
            $table->text('deskripsi');
            $table->text('alamat_pelapor');
            $table->boolean('is_arsip')->default(false);
            $table->timestamps();

            //relasi
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
