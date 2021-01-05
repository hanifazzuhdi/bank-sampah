<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Model\Penyetoran;
use App\Http\Controllers\Controller;
use App\Model\Jenis;
use App\Model\Sampah;
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
        $month = date('m');

        // Card
        $user = User::where('role_id', 1)->where('deleted_at', null)->count();
        $keuangan = Keuangan::latest()->first('saldo');
        $penjualan = Penjualan::whereMonth('created_at', $month)->sum('penghasilan');
        $transaksi = Penyetoran::whereMonth('created_at', $month)->count();;

        // Pie grafik
        $jenis_sampah = Jenis::all();
        foreach ($jenis_sampah as $value) {
            $jenis[] = $value->jenis_sampah;
        }

        foreach ($jenis_sampah as $value) {
            $warna[] = $value->warna;
        }

        $sampahh = Sampah::all();
        foreach ($sampahh as $value) {
            $sampah[] = $value->berat;
        }

        // chart penghasilan

        // Untuk production query pgsql
        $penghasilann = DB::table("penjualans")
            ->select(DB::raw("DATE_TRUNC('month',created_at) AS bulan, SUM(penghasilan) as penghasilan"))
            ->groupBy(DB::raw("DATE_TRUNC('month',created_at)"))
            ->get();

        // query mysql untuk localhost
        // $penghasilann = DB::table("penjualans")
        //     ->select(DB::raw("(SUM(penghasilan)) as penghasilan"))
        //     ->groupBy(DB::raw("MONTH(created_at)"))
        //     ->get();

        $penghasilan = [];

        foreach ($penghasilann as  $value) {
            $penghasilan[] =  $value->penghasilan;
        }

        return view('pages.home', compact('user', 'keuangan', 'penjualan', 'transaksi', 'jenis', 'sampah', 'warna', 'jenis_sampah', 'penghasilan'));
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
