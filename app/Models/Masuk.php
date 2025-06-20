<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuk';
    protected $fillable = [
        'barang_id',
        'jumlah_masuk',
    ];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'kode_barang');
    }
}
