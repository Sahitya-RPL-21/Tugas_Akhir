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
        //tambahkan enum role pada tabel user dengan role produksi
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'kepala', 'admin', 'produksi'])
                ->default('user')
                ->after('password')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //kembalikan enum role pada tabel user ke sebelumnya
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'kepala', 'admin'])
                ->default('user')
                ->after('password')
                ->change();
        });
    }
};
