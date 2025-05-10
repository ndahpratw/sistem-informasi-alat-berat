<?php

namespace App\Models;

use App\Models\Alat;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table = 'penyewaans';
    protected $fillable = ['id_pelanggan', 'id_karyawan', 'tanggal_sewa', 'tanggal_kembali', 'total_biaya', 'status_pembayaran', 'status_penyewaan'];

    public function alat() {
        return $this->belongsTo(Alat::class, 'id_alat', 'id');
    }

    public function pelanggan() {
        return $this->belongsTo(Staff::class, 'id_pelanggan', 'id');
    }
}
