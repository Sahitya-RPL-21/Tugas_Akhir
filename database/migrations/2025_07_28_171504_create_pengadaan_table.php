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
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key ke tabel barang
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');

            // Informasi pengadaan
            $table->integer('jumlah')->unsigned();
            $table->date('tanggal_pengadaan');
            $table->enum('status_pengadaan', ['diajukan', 'disetujui', 'ditolak'])->default('diajukan');
            $table->unsignedBigInteger('user_id'); // user yang mengajukan pengadaan
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaan');
    }
};
