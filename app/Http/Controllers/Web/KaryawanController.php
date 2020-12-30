<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 5)->get();

        return view('pages.karyawan', compact('users'));
    }
}
