<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    public $autoIncrement = false;
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
    protected $fillable = [
        'kode_barang',
        'created_at',
        'updated_at',
        'nama_barang',
        'kategori_barang',
        'unit_barang',
        'stok_barang',
        'status_barang',
    ];
}
