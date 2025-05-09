<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggans');
            $table->unsignedBigInteger('id_karyawans');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->decimal('total_biaya', 10, 2);
            $table->enum('status', ['diproses', 'disetujui', 'ditolak', 'selesai']);
            $table->timestamps(); // Hanya ini, jangan tambah created_at/updated_at lagi
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
