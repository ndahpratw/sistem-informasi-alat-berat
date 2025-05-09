<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = Karyawan::paginate(10); 
        return view('pages.data-karyawan.index', compact('data'));
    }


    public function create()
    {
        // dd($jabatans);
        return view('pages.data-karyawan.create'); // Arahkan ke view form create
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'Posisi' => 'required|string|max:255',
            
        ]);

        Karyawan::create($request->all());

        return redirect()->route('data-karyawan.index')->with('success', 'Data Karyawan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $Karyawan = Karyawan::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'Posisi' => 'required|string|max:255',
           
        ]);
        
        $Karyawan->update($request->all());

        return redirect()->route('data-karyawan.index')->with('success', 'Data Karyawan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $Karyawan = Karyawan::findOrFail($id);
        $Karyawan->delete();

        return redirect()->route('data-karyawan.index')->with('success', 'Data Karyawan berhasil dihapus!');
    }
}
