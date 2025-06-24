<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar'; // Nama tabel di database

    protected $fillable = [
        'barang_id',
        'jumlah_keluar',
    ];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'kode_barang');
    }
}