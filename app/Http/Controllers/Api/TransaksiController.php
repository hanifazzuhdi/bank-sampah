<?php

namespace App\Http\Controllers\Api;

use App\Model\Tabungan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function getSaldo()
    {
        $data = Tabungan::where('user_id', Auth::id())->get();

        return response([
            'status'    => 'success',
            'message'   => 'Data Loaded',
            'data'      => $data
        ]);
    }

    public static function addSaldo($data)
    {
        $last = Tabungan::where('user_id', Auth::id())->chunk('saldo')->latest()->first();

        Tabungan::create([
            'user_id'       =>  Auth::id(),
            'keterangan'    => 'Penjualan Sampah',
            'jenis_sampah'  => $data['jenis_sampah'],
            'berat'         => $data['berat'],
            'debet'         => $data['penghasilan'],
            'kredit'        => 0,
            'saldo'         => $last->saldo + $data['penghasilan']
        ]);
    }
}
