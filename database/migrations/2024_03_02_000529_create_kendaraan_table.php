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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('merk');
            $table->string('model');
            $table->string('warna');
            $table->string('nomor_polisi');
            $table->string('no_rangka');
            $table->string('no_mesin');
            $table->string('scan_bpkb')->nullable(true)->default(null);
            $table->string('scan_stnk')->nullable(true)->default(null);
            $table->string('foto_ktp')->nullable(true)->default(null);
            $table->string('foto_kendaraan')->nullable(true)->default(null);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
