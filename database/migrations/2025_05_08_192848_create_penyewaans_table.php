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
            $table->foreignId('id_pelanggan')->constrained('staff','id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_karyawan')->nullable()->constrained('staff','id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_alat')->constrained('alats','id')->onUpdate('cascade')->onDelete('restrict');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('jumlah_peminjaman');
            $table->decimal('total_biaya', 10, 2);
            $table->string('metode_pembayaran');
            $table->enum('status_pembayaran', ['sudah bayar', 'belum bayar']);
            $table->enum('status_penyewaan', ['menunggu pembayaran', 'diproses', 'disetujui', 'ditolak', 'selesai', 'dibatalkan']);
            $table->timestamps();
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
