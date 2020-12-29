<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    public function index()
    {
        $Sampah = Sampah::with(['jenis'])->orderBy('id', 'ASC')->get();
        return view('sampah.index', compact('Sampah'));
    }
}
