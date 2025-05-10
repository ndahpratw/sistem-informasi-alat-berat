<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenyewaanController extends Controller
{
    public function index() {
        $no = 1;
        $data = Penyewaan::all();
        return view('pages.data-penyewaan.index', compact('no','data'));
    }
}
