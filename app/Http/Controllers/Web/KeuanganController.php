<?php

namespace App\Http\Controllers\Web;

use App\Model\Keuangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::all();
        $saldo = Keuangan::latest()->first('saldo');

        return view('pages.keuangan', compact('keuangan', 'saldo'));
    }
}
