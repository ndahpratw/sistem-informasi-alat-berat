<?php

namespace App\Models;

use App\Models\Pengembalian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denda extends Model
{
    use HasFactory;

    public function pengembalian() {
        return $this->belongsTo(Pengembalian::class, 'id_pengembalian', 'id');
    }
}
