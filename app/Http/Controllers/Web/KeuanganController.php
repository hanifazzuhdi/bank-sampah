<?php

namespace App\Http\Controllers\Web;

use App\Model\Keuangan;
use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $keuangan = Keuangan::orderBy('id', 'desc')->get();
        $saldo = Keuangan::latest()->first('saldo');
        $pengeluaran = Keuangan::whereMonth('created_at', date('m'))->sum('kredit');
        $pemasukan = Keuangan::whereMonth('created_at', date('m'))->where('id', '!=', 1)->sum('debet');

        return view('pages.bendahara.keuangan', compact('keuangan', 'saldo', 'pengeluaran', 'pemasukan'));
    }
}
