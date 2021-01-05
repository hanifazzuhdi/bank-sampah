<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Model\Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{

    public function index()
    {
        $data = Sampah::all();

        return $this->sendResponse('Success', 'data berhasil diload', $data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_sampah' => 'integer|required',
            'berat' => 'string|required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $sampah = Sampah::where('jenis_sampah', $request->jenis_sampah)->firstOrFail();

        if ($sampah->berat < request('berat')) {
            return $this->sendResponse('Error', 'sampah anda kurang', null, 400);
        }

        Penjualan::create([
            'jenis_sampah' => $request->jenis_sampah,
            'berat' => $request->berat,
            'harga' => $request->harga,
            'penghasilan' => $request->berat * $request->harga,
        ]);

        //kurangi stok sampah berdasarkan jenis
        $sampah->berat = $sampah->berat - $request->berat;

        //tambah penghasilan ke data keuangan dan buat catatan pemasukan
        $penghasilan = Keuangan::latest()->first();

        $keuangan = Keuangan::create([
            'keterangan' => request('keterangan') ?? "Hasil penjualan ke pengepul",
            'debit' => $request->berat * $request->harga,
            'kredit' => 0,
            'saldo' => $penghasilan == null ? $request->berat * $request->harga : $penghasilan->saldo + ($request->berat * $request->harga)
        ]);
        try {
            $keuangan->save();
            $sampah->update();
            return $this->sendResponse('Success', 'berhasil menjual sampah masyarakat', $keuangan, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menjual sampah masyarakat', null, 500);
        }
    }
}
