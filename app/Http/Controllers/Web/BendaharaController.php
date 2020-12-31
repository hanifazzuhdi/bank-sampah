<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
    // * Melihat Semua Data Penyetoran Sampah Nasabah
    // • Melihat Total Keselurahan Sampah Hasil Setoran Nasabah
    // • Melihat Data dan Buku Tabungan Semua Nasabah (Agar bisa melayani penarikan uang oleh nasabah)
    // • Melihat Semua Data Penjualan Sampah Ke Pengepul
    // • Melihat Total Keuangan Bank Sampah

    public function penyetoran()
    {
        $penyetoran = Penyetoran::with(['user:name', 'jenis']);
    }

    public function user()
    {
        $user = User::all();
        // return view('', compact('user'));
    }
    public function saldo($id)
    {
        $penarikan = Penarikan::where('user id', $id)->get();
        $Saldo = Tabungan::where('user id', $id)->latest();
        // return view('', compact('Saldo','penarikan');
    }
    public function tarik($id)
    {
        $penarikan = Penarikan::where('id', $id)->get();
        $penarikan->status = 2;
        $penarikan->update();
        $Tabungan = Tabungan::create([
            'user_id'       => $penarikan->user_id,
            'kredit'        => $penarikan->kredit,
            'keterangan'        => 'nasabah mengambil uang',
        ]);
    }

}
