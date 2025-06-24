<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok_opname', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_persediaan')->default(0);
            $table->integer('selisih_barang')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Jika ingin relasi ke tabel barang:
            $table->foreign('kode_barang')->references('kode_barang')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_opname');
    }
};
