<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Keuangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use App\Model\Penyetoran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $penjualan = DB::select("SELECT SUM(penghasilan) as penghasilan FROM penjualans WHERE MONTH(created_at) = $month");
        $transaksi = DB::select("SELECT COUNT(*) as jumlah FROM penyetorans WHERE MONTH(created_at) = $month");

        return view('home', compact('user', 'keuangan', 'penjualan', 'transaksi'));
    }
}
