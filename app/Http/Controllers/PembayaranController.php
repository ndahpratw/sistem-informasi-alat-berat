<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    public function edit($id) {
        $data_penyewaan = Penyewaan::find($id);
        // dd($data_penyewaan);
        return view('pages.customer.pembayaran', compact('data_penyewaan'));
    }

        public function update($id, Request $request) {
        $request->validate([
            'bukti_pembayaran' => 'required',
        ]);

        $pesanan = Penyewaan::find($id);
        $data = $request->except('token', 'submit', 'bukti_pembayaran');

        $image = $request->file('bukti_pembayaran');
        $imageName = $pesanan->created_at->format('ymdHis') . '_' . $pesanan->alat->nama_alat . '_' . auth()->user()->name . '.' . $image->extension();
        $image->move(public_path('assets/img/bukti-pembayaran/'), $imageName);
        $data['bukti_pembayaran'] = $imageName;

        $pesanan->update([
            'bukti_pembayaran' => $imageName,
            'status_penyewaan' => 'diproses',
        ]);

        return redirect('/sewa-alat')->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    public function update_status(Request $request, $id) {
        $penyewaan = Penyewaan::findOrfail($id);
        $penyewaan->update([
            'status_penyewaan' => $request->status_penyewaan,
            'id_karyawan' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Status penyewaan berhasil diupdate!');
    }
}
