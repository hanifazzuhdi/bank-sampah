<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Model\Penyetoran;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('role_id', 1)->count();

        $keuangan = Keuangan::latest()->first('saldo');

        $month = date('m');
        $penjualan = Penjualan::whereMonth('created_at', $month)->sum('penghasilan');
        $transaksi = Penyetoran::whereMonth('created_at', $month)->count();

        return view('pages.home', compact('user', 'keuangan', 'penjualan', 'transaksi'));
    }
}
