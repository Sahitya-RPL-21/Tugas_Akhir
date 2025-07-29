<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'pengadaan';
    public $autoIncrement = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'barang_id',
        'jumlah',
        'tanggal_pengadaan',
        'status_pengadaan',
        'user_id',
        'updated_at',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'id');
    }
}
