<?php

namespace App\Http\Controllers\Web;
use App\Model\Keuangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $Keuangan = Keuangan::all();
        $saldo = Keuangan::latest()->first('saldo');
        return view('keuangan.index', compact('Keuangan','saldo'));
    }
}
