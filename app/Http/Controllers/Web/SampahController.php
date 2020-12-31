<?php

namespace App\Http\Controllers\Web;

use App\Model\Jenis;
use App\Model\Sampah;
use App\Http\Controllers\Controller;

class SampahController extends Controller
{
    public function getSampah()
    {
        $sampahs = Jenis::all();

        return view('pages.sampah', compact('sampahs'));
    }

    public function getGudang()
    {
        $sampahs = Sampah::with(['jenis'])->orderBy('id', 'ASC')->get();

        return view('pages.gudang', compact('sampahs'));
    }
}
