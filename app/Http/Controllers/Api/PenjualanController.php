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
        $saldo = Keuangan::latest()->first('saldo');
        return $this->sendResponse('Success', 'ini dia saldo anda bos', $saldo, 500);
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
        $penjualan = Penjualan::create([
            'jenis_sampah' => $request->jenis_sampah,
            'berat' => $request->berat,
            'harga' => $request->harga,
            'penghasilan' => $request->berat * $request->harga,
        ]);
        //kurangi stok sampah berdasarkan jenis
        $sampah = Sampah::where('id', $request->jenis_sampah)->first();
        if ($sampah->berat < $request->berat) {
            return $this->sendResponse('Error', 'sampah andakurang', null, 500);
        }
        $stok = $sampah->berat - $request->berat;

        //tambah penghasilan ke data keuangan dan buat catatan pemasukan
        $penghasilan = Keuangan::latest()->first();
        $keuangan = Keuangan::create([
            'saldo' => $penghasilan->$saldo + ($request->berat * $request->harga),
            'debet' => $request->berat * $request->harga,
            'kredit'=> 0,
            'keterangan' => "hasil penjualan ke pengepul"
        ]);
        try {
            $keuangan->save();
            return $this->sendResponse('Success', 'berhasil menjual sampah masyarakat', $keuangan, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menjual sampah masyarakat', null, 500);
        }
    }
}