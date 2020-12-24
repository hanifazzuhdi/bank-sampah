<?php

namespace App\Http\Controllers\Api;

use App\Model\Tabungan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Tabungan::where('user_id', Auth::id())->get()->toArray();

        if (!$data) return $this->sendResponse();

        return $this->sendResponse('Success', 'Data Berhasil dimuat', $data, 200);
    }

    public function show()
    {
        $data = Tabungan::where('user_id', Auth::id())->latest()->first();

        if (!$data) return $this->sendResponse();

        return $this->sendResponse('Success', 'Data Berhasil dimuat', $data->saldo, 200);
    }

    public static function addSaldo($data)
    {
        $last = Tabungan::where('user_id', Auth::id())->latest()->first();

        Tabungan::create([
            'user_id'       => Auth::id(),
            'keterangan'    => 'Penjualan Sampah',
            'jenis_sampah'  => $data['jenis_sampah'],
            'berat'         => $data['berat'],
            'debet'         => $data['penghasilan'],
            'kredit'        => 0,
            'saldo'         => $last == null ? 0 + $data['penghasilan'] : $last->saldo + $data['penghasilan']
        ]);
    }

    public function tarik($nominal)
    {
        $data = Tabungan::where('user_id', Auth::id())->latest()->first();

        if ($data == null or $nominal > $data->saldo) {
            return $this->sendResponse('Failed', 'Jual Sampah Dulu Biar Kaya', 'null', 404);
        }

        Tabungan::create([
            'user_id'       => Auth::id(),
            'keterangan'    => 'Penarikan Saldo',
            'jenis_sampah'  => $data['jenis_sampah'],
            'berat'         => $data['berat'],
            'debet'         => 0,
            'kredit'        => $nominal,
            'saldo'         => $data->saldo - $nominal
        ]);

        return $this->sendResponse('Success', 'Dana Berhasil diamabil', $nominal, 202);
    }
}
