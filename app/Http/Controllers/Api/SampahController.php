<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Sampah;

class SampahController extends Controller
{
    public function index()
    {
        return response([
            'status'    => 'success',
            'message'   => 'Data Loaded',
            'data'      => Sampah::all()
        ]);
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
