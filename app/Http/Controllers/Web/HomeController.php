<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\User;
use Auth;

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

        return view('home', compact('user', 'keuangan'));
    }
}
