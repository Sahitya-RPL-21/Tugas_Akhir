<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    use HasFactory;

    protected $table = 'stok_opname';

    protected $fillable = [
        'kode_barang',
        'stok_awal',
        'stok_fisik',
        'selisih_barang',
        'keterangan',
        'user_id',
    ];

    // Jika ingin relasi ke model BarangModel:
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'kode_barang', 'kode_barang');
    }
}
