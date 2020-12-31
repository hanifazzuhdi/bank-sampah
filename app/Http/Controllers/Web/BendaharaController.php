<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
        $penyetoran = Penyetoran::with(['user:name','jenis']);
    }
   
    public function user()
    {
        // $tabungan = Tabungan::with(['User:id,name,email'])->distinc()->latest();
        $user = User::all();
        // return view('', compact('User'));

    }
    public function saldo($id)
    {
        
        $Saldo = Tabungan::where('user id', $id)->latest();
        // return view('', compact('Saldo'));
    }


}
