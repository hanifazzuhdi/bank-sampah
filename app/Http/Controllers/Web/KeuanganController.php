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
        $pengeluaran = Keuangan::whereMonth('created_at', date('m'))->sum('kredit');
        $pemasukan = Keuangan::whereMonth('created_at', date('m'))->where('id', '!=', 1)->sum('debet');

        return view('pages.keuangan', compact('keuangan', 'saldo', 'pengeluaran', 'pemasukan'));
    }
}
