<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Tabungan;
use App\Model\Keuangan;
use App\Model\Penarikan;
use App\Model\Penyetoran;
use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function penyetoran()
    {
        $datas = Penyetoran::with('user', 'jenis')->get();

        return view('pages.bendahara.penyetoran', compact('datas'));
    }

    public function penjualan()
    {
        $datas = Penjualan::with('jenis')->get();

        return view('pages.bendahara.penjualan', compact('datas'));
    }

    public function saldo($id)
    {
        $penarikan = Penarikan::where('user id', $id)->get();
        $Saldo = Tabungan::where('user id', $id)->latest()->first('saldo');
        $tabungan = Tabungan::where('user id', $id)->get();

        // return view('', compact('Saldo','penarikan');
    }
}
