<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Penarikan;
use App\Model\Penyetoran;
use App\Model\Tabungan;
use App\User;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('bendahara')) {
            return view('bendahara.index');
        } else {
            return redirect('/');
        }
    }
    public function penyetoran()
    {
        $penyetoran = Penyetoran::all();
    }
    public function saldo($id)
    {
        $penarikan = Penarikan::where('user id', $id)->get();
        $Saldo = Tabungan::where('user id', $id)->latest()->first('saldo');
        $tabungan = Tabungan::where('user id', $id)->get();

        // return view('', compact('Saldo','penarikan');
    }
    public function tarik($id)
    {

        $penarikan = Penarikan::where('id', $id)->get();
        $penarikan->status = 2;
        $penarikan->update();
        // Saldo Keuangan berkurang otomatis
        Keuangan::create([
            'keterangan' => 'Penarikan Uang Oleh Nasabah',
            'debet'      => 0,
            'kredit'     => $penarikan->kredit,
            'saldo'      => Keuangan::latest()->first()->saldo - $penarikan->kredit
        ]);
    }
}
