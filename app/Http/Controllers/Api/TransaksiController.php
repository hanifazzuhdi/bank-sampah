<?php

namespace App\Http\Controllers\Api;

use App\Model\Tabungan;
use App\Model\Penarikan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\TelegramNotif;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Tabungan::where('user_id', Auth::id())->get();

        if ($data == '[]') return $this->sendResponse();

        foreach ($data as $key => $value) {
            # code...
            $data[$key]->saldo = number_format($data[$key]->saldo, 0, ',', '.');
        }

        return $this->sendResponse('Success', 'Data Berhasil dimuat', $data, 200);
    }

    public function show()
    {
        $data = Tabungan::where('user_id', Auth::id())->latest()->first();

        if (!$data) return $this->sendResponse();

        return $this->sendResponse('Success', 'Data Berhasil dimuat', number_format($data->saldo, 0, ',', '.'), 200);
    }

    public static function addSaldo($data)
    {
        $last = Tabungan::where('user_id', Auth::id())->latest()->first();

        Tabungan::create([
            'user_id'       => Auth::id(),
            'keterangan'    => 'Penjualan Sampah ke Bank Sampah',
            'debit'         => $data['penghasilan'],
            'kredit'        => 0,
            'saldo'         => $last == null ? 0 + $data['penghasilan'] : $last->saldo + $data['penghasilan']
        ]);
    }

    public function tarik()
    {
        request()->validate([
            'nama'      => 'required',
            'rekening'  => 'required',
            'nominal'   => 'required',
        ]);

        $data = Tabungan::where('user_id', Auth::id())->latest()->first();

        if ($data == null or request('nominal') > ($data->saldo - 3000)) {
            return $this->sendResponse('Failed', 'Saldo Anda Tidak Cukup', 'null', 404);
        }

        Tabungan::create([
            'user_id'       => Auth::id(),
            'keterangan'    => 'Penarikan Saldo',
            'debit'         => 0,
            'kredit'        => request('nominal'),
            'saldo'         => ($data->saldo -= request('nominal')) - 3000
        ]);

        $penarikan = Penarikan::create([
            'user_id'       => Auth::id(),
            'nama'          => request('nama'),
            'rekening'      => request('rekening'),
            'kredit'        => request('nominal'),
            'keterangan'    => 'Penarikan Saldo',
            'status'        => 1,
        ]);

        $user = Auth::user();
        $user->notify(new TelegramNotif($user->email, $penarikan));

        return $this->sendResponse('Success', 'Permintaan Sedang di Proses, Menunggu Saldo dikirim', $penarikan, 202);
    }

    public function riwayat()
    {
        $datas = Penarikan::where('user_id', Auth::id())->get();

        return $this->sendResponse('Success', 'Riwayat berhasil ditampilkan', $datas, 200);
    }
}
