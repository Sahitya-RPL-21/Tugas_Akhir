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
        // Create the 'barang' table
        Schema::create('barang', function (Blueprint $table) {
            $table->id()->primary(); // Auto-incrementing ID
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('kategori_barang');
            // jenis barang enum jadi dan mentah
            $table->enum('jenis_barang', ['jadi', 'mentah'])->default('mentah');
            // unit barang
            $table->string('unit_barang');
            $table->integer('stok_barang');
            $table->enum('status_barang', ['Tersedia', 'Tidak Tersedia']);
            //user_id references the users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
