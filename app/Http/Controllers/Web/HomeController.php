<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Jenis;
use App\Model\Sampah;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Model\Penyetoran;
use App\Model\Penarikan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\hargasampah;

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
            $harga[] = $value->harga;
        }

           $sampahh = Sampah::all();
        foreach ($sampahh as $value) {
            $sampah[] = $value->berat;
        }

        // chart penghasilan
        if (env('APP_ENV') == 'local') {
            // query mysql untuk localhost
            $penghasilann = DB::table("penjualans")
                ->select(DB::raw("(SUM(penghasilan)) as penghasilan"))
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->get();
        } else {
            // Untuk production query pgsql heroku
            $penghasilann = DB::table("penjualans")
                ->select(DB::raw("DATE_TRUNC('month',created_at) AS bulan, SUM(penghasilan) as penghasilan"))
                ->groupBy(DB::raw("DATE_TRUNC('month',created_at)"))
                ->get();
        }

        $penghasilan = [];

        foreach ($penghasilann as  $value) {
            $penghasilan[] =  $value->penghasilan;
        }
        // ini buat chart kenaikan harga
        $harga_sampah = hargasampah::all();
        foreach ($harga_sampah as $value) {
            $label[] = $value->created_at;
            $hargae[] = $value->harga;
$jenise[] = $value->jenis;
        }
        return view('pages.home', compact('user', 'keuangan', 'penjualan', 'transaksi', 'jenis','jenise', 'sampah', 'warna', 'jenis_sampah', 'penghasilan', 'harga','label','hargae'));
    }

    public function alert()
    {
        $permintaan = Penarikan::where('status', 1)->count();

        echo json_encode($permintaan);
    }

    public function laporan()
    {
    }


    public function peringkat()
    {
    $peringkat = DB::table('penyetoran')->select("SUM(penyetoran)");    
    }
}
