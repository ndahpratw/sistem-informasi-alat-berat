<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
     public function index()
    {
        $data = Alat::paginate(10); 
        return view('pages.data-alat.index', compact('data'));
    }

      // Simpan data alat baru
   public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:100',
            'tipe' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $imageName = now()->format('YmdHis') . $request->email . '.' . $gambar->extension();
            $gambar->move(public_path('assets/img/gambar/'), $imageName);
        } else {
            $imageName = null;
        }

        // Menyimpan alat ke database termasuk nama gambar
        Alat::create([
            'nama_alat' => $validated['nama_alat'],
            'tipe' => $validated['tipe'],
            'stok' => $validated['stok'],
            'harga_sewa' => $validated['harga_sewa'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $imageName,  // Simpan nama gambar ke database
        ]);

        return redirect()->back()->with('success', 'Data alat berhasil ditambahkan.');
    }


    // Update data alat
    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $validated = $request->validate([
            'nama_alat' => 'required|string|max:100',
            'tipe' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hapus gambar lama jika ada dan diganti dengan gambar baru
        if ($request->hasFile('gambar')) {
            // Jika ada gambar lama, hapus
            if ($alat->gambar) {
                Storage::disk('public')->delete('gambar-alat/' . $alat->gambar);
            }
            
            // Upload gambar baru
            $gambar = $request->file('gambar');
            $imageName = now()->format('YmdHis') . '.' . $gambar->extension();
            $gambar->move(public_path('assets/img/gambar/'), $imageName);
            
            // Simpan nama gambar baru di database
            $validated['gambar'] = $imageName;
        }

        // Update data alat dengan gambar baru atau tanpa gambar
        $alat->update($validated);

        return redirect()->route('data-alat.index')->with('success', 'Data alat berhasil diperbarui.');
    }

    // Hapus alat
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        // Hapus gambar jika ada
        if ($alat->gambar) {
            // Hapus gambar dari folder 'public/assets/img/gambar/'
            Storage::disk('public')->delete('gambar-alat/' . $alat->gambar);
        }

        // Hapus data alat dari database
        $alat->delete();

        return redirect()->route('data-alat.index')->with('success', 'Data alat berhasil dihapus.');
    }
}
