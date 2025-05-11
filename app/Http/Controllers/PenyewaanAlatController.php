<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanAlatController extends Controller
{
    public function main() {
        $alat_berat = Alat::all();
        return view('landingpage', compact('alat_berat'));
    }

    public function index() {
        $riwayat_penyewaan = Penyewaan::where('id_pelanggan', auth()->user()->id)->get();
        return view('pages.customer.riwayat-penyewaan', compact('riwayat_penyewaan'));
    }

    public function edit($id) {
        $alat_berat = Alat::findOrfail($id);
        return view('pages.customer.sewa-alat', compact('alat_berat'));
    }

    public function store(Request $request) {
        // dd($request);
        $request->validate([
            'jumlah' => 'required|min:0',
            'total' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'metode_pembayaran' => 'required',
        ]);

        $alat_berat = Alat::find($request->alat);

        $penyewaan = new Penyewaan();
        $penyewaan->id_pelanggan = auth()->user()->id;
        $penyewaan->id_alat = $request->alat;
        $penyewaan->tanggal_sewa = $request->tanggal_sewa;
        $penyewaan->tanggal_kembali = $request->tanggal_kembali;
        $penyewaan->jumlah_peminjaman = $request->jumlah;
        $penyewaan->total_biaya = $request->total;
        $penyewaan->metode_pembayaran = $request->metode_pembayaran;
        $penyewaan->status_penyewaan = 'menunggu pembayaran';

        if ($penyewaan->save()) {
            $alat_berat->decrement('stok', $request->jumlah);
            return redirect('sewa-alat')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }

    public function cancel_sewa($id) {
        $penyewaan = Penyewaan::findOrfail($id);
        $alat_berat = Alat::where('id', $penyewaan->id_alat)->first();

        $penyewaan->update([
            'status_penyewaan' => 'dibatalkan',
        ]);

        $alat_berat->increment('stok', $penyewaan->jumlah_peminjaman);
        return redirect()->back()->with('success', 'Penyewaan Alat Berhasil Dibatalkan!');
    }


}
