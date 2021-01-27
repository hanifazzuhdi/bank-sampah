<?php

namespace App\Http\Controllers\Api;

use App\Model\Jenis;
use App\Model\Sampah;
use App\Http\Controllers\Controller;

class SampahController extends Controller
{
    public function index()
    {    
        $data = Sampah::with(['jenis'])->orderBy('id', 'ASC')->get();

        return $this->sendResponse('Success', 'Data Sampah Berhasil dimuat', $data, 200);
    }

    public function getJenis()
    {
        $data = Jenis::orderBy('id', 'ASC')->get();

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
