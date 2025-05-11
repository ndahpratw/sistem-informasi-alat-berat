<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index() {
        $denda = Denda::all();
        return view('pages.data-denda.index', compact('denda'));
    }
}
