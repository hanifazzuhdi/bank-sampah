<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Tabungan;
use App\Model\Keuangan;
use App\Model\Penarikan;
use App\Model\Penyetoran;
use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function penyetoran()
    {
        $datas = Penyetoran::with('user', 'jenis')->get();

        return view('pages.penyetoran', compact('datas'));
    }

    public function penjualan()
    {
        $datas = Penjualan::with('jenis')->get();

        return view('pages.penjualan', compact('datas'));
    }

    public function saldo($id)
    {
        $penarikan = Penarikan::where('user id', $id)->get();
        $Saldo = Tabungan::where('user id', $id)->latest()->first('saldo');
        $tabungan = Tabungan::where('user id', $id)->get();

        // return view('', compact('Saldo','penarikan');
    }

    public function tarik($id)
    {

        $penarikan = Penarikan::where('id', $id)->get();
        $penarikan->status = 2;
        $penarikan->update();
        // Saldo Keuangan berkurang otomatis
        Keuangan::create([
            'keterangan' => 'Penarikan Uang Oleh Nasabah',
            'debet'      => 0,
            'kredit'     => $penarikan->kredit,
            'saldo'      => Keuangan::latest()->first()->saldo - $penarikan->kredit
        ]);
    }
    public function tarik_tunai(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'nominal'   => 'required',
            'user_id'   => 'required',
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        }
        $data = Tabungan::where('user_id', request('user_id'))->latest()->first();

        if ($data == null or request('nominal') > $data->saldo) {
            return $this->sendResponse('Failed', 'Jual Sampah Dulu Biar Kaya', 'null', 404);
        }

        Tabungan::create([
            'user_id'       => request('user_id'),
            'keterangan'    => 'Penarikan Saldo',
            'jenis_sampah'  => null,
            'berat'         => null,
            'debet'         => null,
            'kredit'        => request('nominal'),
            'saldo'         => $data->saldo - request('nominal')
        ]);

        Penarikan::create([
            'user_id'       => request('user_id'),
            'nama'          => request('nama'),
            'rekening'      => null,
            'kredit'        => request('nominal'),
            'keterangan'    => 'Penarikan Saldo',
            'status'        => 2,
        ]);
        Keuangan::create([
            'keterangan' => 'Penarikan Uang Oleh Nasabah',
            'debet'      => 0,
            'kredit'     => request('nominal'),
            'saldo'      => Keuangan::latest()->first()->saldo - request('nominal')
        ]);
    }
}
