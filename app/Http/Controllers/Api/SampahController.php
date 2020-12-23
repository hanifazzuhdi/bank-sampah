<?php

namespace App\Http\Controllers\Api;

use App\Model\Sampah;
use App\Http\Controllers\Controller;
use App\Model\Jenis;

class SampahController extends Controller
{
    public function index()
    {
        $data = Sampah::with(['jenis'])->get();

        return response([
            'status'    => 'success',
            'message'   => 'Data Loaded',
            'data'      =>  $data
        ]);
    }

    public function getJenis()
    {
        $data = Jenis::all();

        return $this->sendResponse('Success', 'Data Jenis Sampah Dimuat', $data, 200);
    }

    public function show($id)
    {
        $data = Sampah::find($id);

        if (!$data) {
            return $this->sendResponse();
        }

        return response([
            'status'  => 'Success',
            'message' => 'Data Sampah dimuat',
            'data'    => $data
        ]);
    }

    public static function addSampah($data)
    {
        $sampah = Sampah::find($data['jenis_sampah']);

        $sampah->update([
            'berat' => $sampah->berat += $data['berat']
        ]);
    }
}
