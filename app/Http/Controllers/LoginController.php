<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Staff;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login'); // Pastikan Anda memiliki view login.blade.php
    }

    public function dashboard()
    {
        $informasi = Carbon::now();
        $customer = Staff::where('role', 'Pelanggan')->count();
        $pemasukan = Penyewaan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereIn('status_penyewaan', ['disetujui', 'selesai'])
            ->sum('total_biaya');
        $denda = Denda::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('jumlah_denda');

        $labels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $tahunDipilih = request('tahun', now()->year);
        $totalPemasukan = Penyewaan::whereYear('created_at', $tahunDipilih)
            ->whereIn('status_penyewaan', ['disetujui', 'selesai'])
            ->sum('total_biaya');
        $totalDenda = Denda::whereYear('created_at', $tahunDipilih)
            ->sum('jumlah_denda');

        // grafik pemasukan
        $totals = [];
        $dendaTotals = [];
        foreach (range(1, 12) as $month) {
            // Total biaya penyewaan yang disetujui dan selesai
            $totalBiaya = Penyewaan::whereIn('status_penyewaan', ['disetujui', 'selesai'])
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $tahunDipilih)
                ->sum('total_biaya');

            // Total jumlah denda
            $totalDenda = DB::table('dendas')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $tahunDipilih)
                ->sum('jumlah_denda');

            $totals[] = $totalBiaya;
            $dendaTotals[] = $totalDenda;
        }

        // grafik total alat
        $perAlat = Penyewaan::selectRaw('id_alat, SUM(jumlah_peminjaman) as total_peminjaman')
            ->groupBy('id_alat')
            ->whereYear('created_at', now()->year)
            ->with('alat')
            ->get();
        $alatLabels = $perAlat->map(function ($item) {
            return $item->alat->nama_alat ?? 'Tidak Diketahui';
        });
        $jumlahPeminjaman = $perAlat->pluck('total_peminjaman');

        return view('pages.dashboard', compact('informasi', 'customer', 'pemasukan', 'denda', 'totalPemasukan', 'totalDenda', 'labels', 'totals', 'dendaTotals', 'alatLabels', 'jumlahPeminjaman'));
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Kolom Email tidak boleh kosong.',
            'password.required' => 'Kolom Password tidak boleh kosong.',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if (in_array($user->role, ['Admin', 'Bendahara'])) {
                return redirect('/dashboard');
            } elseif ($user->role === 'Pelanggan') {
                return redirect('/');
            } else {
                Auth::logout(); // logout jika role tidak dikenali
                return redirect('/login')->with('wrong', 'Role tidak ditemukan!');
            }
        }

        return redirect('/login')->with('wrong', 'Email dan password tidak tersedia');
    }

    public function logout() {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if (in_array($role, ['Admin', 'Bendahara', 'Pelanggan'])) {
                Auth::logout();
            }
        }
        return redirect('/');
}
}