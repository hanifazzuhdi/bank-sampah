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
        $Customer = Auth::user()->name;
        $User = User::where('role_id', 1)->count();
        $Keuangan = Keuangan::latest()->first('saldo');
        return view('home', compact('User', 'Customer', 'Keuangan'));
    }
}
