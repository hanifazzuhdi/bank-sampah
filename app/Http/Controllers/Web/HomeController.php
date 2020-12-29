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
        $userAuth = User::where('id', Auth::id())->first();

        $user = User::where('role_id', 1)->count();

        $keuangan = Keuangan::latest()->first('saldo');

        $sapa = $this->sapa() . $userAuth->name;

        return view('home', compact('userAuth', 'user', 'keuangan', 'sapa'));
    }
}
