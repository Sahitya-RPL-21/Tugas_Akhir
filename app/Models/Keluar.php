<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluar'; // Nama tabel di database

    protected $fillable = [
        'barang_id',
        'jumlah_keluar',
        'keterangan',
        'user_id',
    ];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'id');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
