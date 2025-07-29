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
        Schema::create('pengajuan_produksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_mentah_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah_pengajuan');
            //status pengajuan enum
            $table->enum('status_pengajuan', ['diajukan', 'ditolak', 'disetujui'])->default('diajukan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_pengajuan_produksi');
    }
};
