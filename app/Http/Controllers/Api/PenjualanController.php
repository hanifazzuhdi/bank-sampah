<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\Model\Penjualan;
use App\Model\Sampah;
use Dotenv\Validator;
use Illuminate\Http\Request;

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
        $sampah = Sampah::where('id', 'jenis_sampah')->first();
        $stok = $sampah->berat - $request->berat;

        //tambah penghasilan ke data keuangan dan buat catatan pemasukan
        $penghasilan = Keuangan::first()->latest();
        $keuangan = Penjualan::create([
            'saldo' => $penghasilan->saldo + $request->berat * $request->harga,
            'debet' => $request->berat * $request->harga,
            'keterangan' => "hasil penjualan ke pengepul"
        ]);
        try {
            $penjualan->save();
            return $this->sendResponse('Success', 'berhasil menjual sampah masyarakat', $penjualan, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menjual sampah masyarakat', null, 500);
        }
    }
}