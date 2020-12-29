<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('bendahara')) {
            return view('bendahara.index');
        } else {
            return redirect('/');
        } 
    }
}
