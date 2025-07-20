<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuk';
    protected $fillable = [
        'barang_id',
        'jumlah_masuk',
        'keterangan',
        'user_id',
    ];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
