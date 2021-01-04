<?php

namespace App\Http\Controllers\Web;

use App\Model\Keuangan;
use App\Http\Controllers\Controller;
use App\Model\Penarikan;
use App\Model\Penjualan;
use App\User;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    // GET
    public function index()
    {
        $keuangan = Keuangan::orderBy('id', 'desc')->get();
        $saldo = Keuangan::latest()->first('saldo');
        $pengeluaran = Keuangan::whereMonth('created_at', date('m'))->sum('kredit');
        $pemasukan = Keuangan::whereMonth('created_at', date('m'))->where('id', '!=', 1)->sum('debet');

        return view('pages.bendahara.keuangan', compact('keuangan', 'saldo', 'pengeluaran', 'pemasukan'));
    }

    public function getPenarikan()
    {
        return view('pages.bendahara.penarikan.penarikan');
    }

    public function getPermintaan()
    {
        return view('pages.bendahara.penarikan.permintaan');
    }

    // POST
    public function penarikan()
    {
        request()->validate([
            'email'  => 'required|email',
            'nominal' => 'required'
        ]);

        $user = User::where('email', request('email'))->first();

        $penarikan = new Penarikan();
        $penarikan->user_id = $user->id;
        $penarikan->alias = $user->name;
        $penarikan->rekening = "Melalui Teller";
        $penarikan->kredit  = request('nominal');
        $penarikan->keterangan = request('keterangan') ?? "Penarikan Tunai Melalui Teller";
        $penarikan->status = 2;

        $penarikan->save();
    }
}
