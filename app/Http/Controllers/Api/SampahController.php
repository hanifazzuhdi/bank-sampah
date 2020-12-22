<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Sampah;

class SampahController extends Controller
{
    public static function addSampah($data)
    {
        $sampah = Sampah::find($data['jenis_sampah']);

        $sampah->update([
            'berat' => $sampah->berat += $data['berat']
        ]);
    }
}
