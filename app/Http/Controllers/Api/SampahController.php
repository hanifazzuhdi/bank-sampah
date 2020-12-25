<?php

namespace App\Http\Controllers\Api;

use App\Model\Sampah;
use App\Http\Controllers\Controller;
use App\Model\Jenis;

class SampahController extends Controller
{
    public function index()
    {
        $data = Sampah::with(['jenis'])->orderBy('id', 'ASC')->get();

        return $this->sendResponse('Success', 'Data Sampah Berhasil dimuat', $data, 200);
    }

    public function getJenis()
    {
        $data = Jenis::all();

        return $this->sendResponse('Success', 'Data Jenis Sampah Dimuat', $data, 200);
    }

    public function show($id)
    {
        $data = Sampah::findOrFail($id);

        return $this->sendResponse('Success', 'Data Sampah Berhasil Dimuat', $data, 200);
    }

    public static function addSampah($data)
    {
        $sampah = Sampah::find($data['jenis_sampah']);

        $sampah->update([
            'berat' => $sampah->berat += $data['berat']
        ]);
    }
}
