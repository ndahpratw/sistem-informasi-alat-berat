<?php

namespace App\Models;

use App\Models\Denda;
use App\Models\Penyewaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';
    protected $fillable = ['id_penyewaan', 'tanggal_dikembalikan', 'kondisi_alat', 'jumlah_alat'];

    public function penyewaan() {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan', 'id');
    }

    public function denda()
    {
        return $this->hasOne(Denda::class, 'id_pengembalian');
    }

}
