<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table = 'penyewaans';
    protected $fillable = [
        'id_pelanggan', 'id_karyawan', 'tanggal_sewa',
        'tanggal_kembali', 'total_biaya', 'status'
    ];
}
