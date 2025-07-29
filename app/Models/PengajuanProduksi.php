<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanProduksi extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_produksi';

    protected $fillable = [
        'barang_mentah_id',
        'jumlah_pengajuan',
        'status_pengajuan',
        'user_id',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function barangMentah()
    {
        return $this->belongsTo(BarangModel::class, 'barang_mentah_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
