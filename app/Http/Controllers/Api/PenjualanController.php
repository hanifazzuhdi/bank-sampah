<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Dotenv\Validator;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_sampah' => 'required|string|max:100',
                'berat' => 'required',
            'penghasilan' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        }
        $penjualan = Penjualan::create([
            'jenis_sampah' => $request->jenis_sampah,
            'berat' => $request->berat,
            'penghasilan' => $request->penghasilan
        ]);
        try {
            $penjualan->save();
            return $this->sendResponse('Success', 'berhasil menjual barang ilegal', $penjualan, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menjual data pemerintah', null, 500);
        }
    }
}