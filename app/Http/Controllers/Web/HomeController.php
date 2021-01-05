<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Model\Penyetoran;
use App\Http\Controllers\Controller;
use App\Model\Jenis;
use App\Model\Sampah;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('role_id', 1)->where('deleted_at', null)->count();

        $keuangan = Keuangan::latest()->first('saldo');
        $month = date('m');
        $penjualan = Penjualan::whereMonth('created_at', $month)->sum('penghasilan');
        $transaksi = Penyetoran::whereMonth('created_at', $month)->count();;

        $jenis_sampah = Jenis::all();

        foreach ($jenis_sampah as $value) {
            # code...
            $jenis[] = $value->jenis_sampah;
        }

        foreach ($jenis_sampah as $value) {
            # code...
            $warna[] = $value->warna;
        }

        $sampahh = Sampah::all();

        foreach ($sampahh as $value) {
            # code...
            $sampah[] = $value->berat;
        }

        return view('pages.home', compact('user', 'keuangan', 'penjualan', 'transaksi', 'jenis', 'sampah', 'warna', 'jenis_sampah'));
    }

    public function sampah()
    {
        $data = Jenis::get('jenis_sampah');

        echo json_encode($data);
    }

    public function laporan()
    {
    }
}
