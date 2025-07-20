<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    public $autoIncrement = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'kategori_barang',
        'unit_barang',
        'stok_barang',
        'status_barang',
        'user_id',
        'updated_at',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
