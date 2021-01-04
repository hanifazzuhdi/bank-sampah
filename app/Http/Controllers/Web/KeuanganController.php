<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Tabungan;
use App\Model\Keuangan;
use App\Model\Penarikan;
use App\Http\Controllers\Controller;

class KeuanganController extends Controller
{
    // GET
    public function index()
    {
        $keuangan = Keuangan::orderBy('id', 'desc')->get();
        $saldo = Keuangan::latest()->first('saldo');
        $pengeluaran = Keuangan::whereMonth('created_at', date('m'))->sum('kredit');
        $pemasukan = Keuangan::whereMonth('created_at', date('m'))->where('id', '!=', 1)->sum('debit');

        return view('pages.bendahara.keuangan', compact('keuangan', 'saldo', 'pengeluaran', 'pemasukan'));
    }

    public function getPenarikan()
    {
        return view('pages.bendahara.penarikan.penarikan');
    }

    public function getPermintaan()
    {
        $datas = Penarikan::where('status', 1)->get();

        return view('pages.bendahara.penarikan.permintaan', compact('datas'));
    }

    // POST
    public function penarikan()
    {
        request()->validate([
            'email'  => 'required|email',
            'nominal' => 'required|integer'
        ]);

        $user = User::where('email', request('email'))->firstOrfail();
        $tabungan = Tabungan::where('user_id', $user->id)->latest()->firstOrFail();

        if ($tabungan->saldo < request('nominal')) {
            alert()->warning('Gagal', 'Saldo Nasabah Tidak Cukup');
            return back();
        }

        // Tambah data di table penarikan
        $penarikan = Penarikan::create([
            'user_id'    => $user->id,
            'nama'       => $user->name,
            'rekening'   => "Melalui Teller",
            'kredit'     => request('nominal'),
            'keterangan' => request('keterangan') ?? "Penarikan Tunai Melalui Teller",
            'status'     => 2
        ]);

        // tambah data di table tabungan nasabah
        Tabungan::create([
            'user_id'       => $user->id,
            'keterangan'    =>  request('keterangan') ?? "Penarikan Tunai Melalui Teller",
            'debit'         => 0,
            'kredit'        => request('nominal'),
            'saldo'         => $tabungan->saldo -= request('nominal')
        ]);

        // kurangi saldo keuangan bank
        $keuangan = Keuangan::latest()->first('saldo');

        Keuangan::create([
            'keterangan' => 'Penarikan Dana Nasabah Melalui Teller',
            'debit'      => 0,
            'kredit'     => request('nominal'),
            'saldo'      => $keuangan->saldo -= request('nominal')
        ]);

        alert()->success('Success', 'Saldo Berhasil ditarik');

        return redirect(route('keuangan.penarikan'))->with('data', $penarikan);
    }

    // Konfirmasi
    public function konfirmasi($id)
    {
        $penarikan = Penarikan::where('id', $id)->first();
        $penarikan->status = 2;
        $penarikan->update();

        // Saldo Keuangan berkurang otomatis
        Keuangan::create([
            'keterangan' => 'Penarikan Uang Oleh Nasabah',
            'debit'      => 0,
            'kredit'     => $penarikan->kredit,
            'saldo'      => Keuangan::latest()->first()->saldo -= $penarikan->kredit
        ]);

        alert()->success('Success', 'Dana Berhasil dikirim');
        return back();
    }

    // tolak
    public function tolak($id)
    {
        $penarikan = Penarikan::where('id', $id)->first();
        $penarikan->status = 0;
        $penarikan->update();

        // kembalikan saldo nasabah
        Tabungan::create([
            'user_id'       => $penarikan->user_id,
            'keterangan'    => 'Pengembalian Saldo Transaksi Gagal',
            'debit'         => $penarikan->kredit,
            'kredit'        => 0,
            'saldo'         => Tabungan::latest()->first()->saldo += $penarikan->kredit + 3000
        ]);

        alert()->info('Success', 'Permintaan Berhasil ditolak');
        return back();
    }
}
