<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alat;
use App\Models\Denda;
use App\Models\Penyewaan;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengembalianController extends Controller
{
    public function index() {
        $data_pengembalian = Penyewaan::where('status_penyewaan', 'disetujui')->orderBy('tanggal_kembali', 'asc')->get();
        return view('pages.data-pengembalian.index', compact('data_pengembalian'));
    }

    public function store(Request $request) {
        $request->validate([
            'tanggal_pengembalian' => 'required',
            'jumlah_pengembalian' => 'required',
            'kondisi_alat' => 'required',
        ]);

        $penyewaan = Penyewaan::find($request->id_penyewaan);
        $alat_berat = Alat::find($penyewaan->id_alat);

        $pengembalian = new Pengembalian();
        $pengembalian->id_penyewaan = $penyewaan->id;
        $pengembalian->tanggal_dikembalikan = $request->tanggal_pengembalian;
        $pengembalian->jumlah_alat = $request->jumlah_pengembalian;
        $pengembalian->kondisi_alat = $request->kondisi_alat;

        if ($pengembalian->save()) {
            $alat_berat->increment('stok', $request->jumlah_pengembalian);

            $penyewaan->update([
                'status_penyewaan' => 'selesai',
            ]);

            if ($request->denda > 0) {

                $data_pengembalian = Pengembalian::where('id_penyewaan', $penyewaan->id)->first();

                $tanggal_kembali = Carbon::parse($penyewaan->tanggal_kembali);
                $tanggal_pengembalian = Carbon::parse($request->tanggal_pengembalian);

                $jumlah_hari_denda = $tanggal_pengembalian->diffInDays($tanggal_kembali, false);

                $denda = new Denda();
                $denda->id_pengembalian = $data_pengembalian->id;
                $denda->jumlah_denda = $request->denda;
                $denda->alasan = 'Pengguna terlambat melakukan pengembalian alat selama '. $jumlah_hari_denda . ' hari';
                $denda->save();
            }
            return redirect('data-penyewaan')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }

    }
}
