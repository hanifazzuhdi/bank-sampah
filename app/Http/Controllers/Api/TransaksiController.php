<?php

namespace App\Http\Controllers\Api;

use App\Model\Tabungan;
use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Penarikan;
use Illuminate\Support\Facades\Auth;

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
            'keterangan'    => 'Penjualan Sampah',
            'jenis_sampah'  => $data['jenis_sampah'],
            'berat'         => $data['berat'],
            'debet'         => $data['penghasilan'],
            'kredit'        => 0,
            'saldo'         => $last == null ? 0 + $data['penghasilan'] : $last->saldo + $data['penghasilan']
        ]);
    }

    public function tarik()
    {
        $request = request()->validate([
            'nama'      => 'required',
            'rekening'  => 'required',
            'nominal'   => 'required',
        ]);

        $data = Tabungan::where('user_id', Auth::id())->latest()->first();

        if ($data == null or request('nominal') > $data->saldo) {
            return $this->sendResponse('Failed', 'Jual Sampah Dulu Biar Kaya', 'null', 404);
        }

        Tabungan::create([
            'user_id'       => Auth::id(),
            'keterangan'    => 'Penarikan Saldo',
            'jenis_sampah'  => null,
            'berat'         => null,
            'debet'         => null,
            'kredit'        => request('nominal'),
            'saldo'         => $data->saldo - request('nominal')
        ]);

        Penarikan::create([
            'user_id'       => Auth::id(),
            'nama'          => request('nama'),
            'rekening'      => request('rekening'),
            'kredit'        => request('nominal'),
            'keterangan'    => 'Penarikan Saldo',
            'status'        => 1,
        ]);

        return $this->sendResponse('Success', 'Permintaan Sedang di Proses, Menunggu Saldo dikirim', request('nominal'), 202);
    }

    public function kirim($nominal)
    {
        // request kirim uang dan update buku tabungan
        $data = Tabungan::where('user_id', Auth::id())->latest()->first();

        if ($data == null or $nominal > $data->saldo) {
            return $this->sendResponse('Failed', 'Jual Sampah Dulu Biar Kaya', 'null', 404);
        }

        Tabungan::create([
            'user_id'       => Auth::id(),
            'keterangan'    => request('keterangan') ?? 'Kirim Saldo ke pengguna lain',
            'jenis_sampah'  => null,
            'berat'         => null,
            'debet'         => 0,
            'kredit'        => $nominal,
            'saldo'         => $data->saldo - $nominal
        ]);

        // Tambahkan Saldo ke nasabah yang dikirim
        $penerima = Tabungan::where('email', request('email'))->latest()->first();

        Tabungan::create([
            'user_id'       => $penerima->user_id,
            'keterangan'    => request('keterangan') ?? 'Kirim Saldo dari pengguna lain',
            'jenis_sampah'  => null,
            'berat'         => null,
            'debet'         => $nominal,
            'kredit'        => 0,
            'saldo'         => $penerima->saldo + $nominal
        ]);

        return $this->sendResponse('Success', 'Saldo Berhasil Dikirim ke Pengguna Lain', 202);
    }
}
