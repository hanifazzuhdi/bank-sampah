<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index()
    {
        $Tabungan = Tabungan::all();
        return view('tabungan.index', compact('Tabungan'));
    }
}
