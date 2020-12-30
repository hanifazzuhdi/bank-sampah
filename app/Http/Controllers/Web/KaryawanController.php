<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;

class KaryawanController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->get();

        return view('pages.karyawan', compact('users'));
    }
}
