<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Model\Keuangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('role_id', 1)->count();

        $keuangan = Keuangan::latest()->first('saldo');

        $sapa = $this->sapa();

        return view('home', compact('user', 'keuangan', 'sapa'));
    }
}
