<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function nasabah()
    {
        $user = DB::table('users')->select('*')->where('id','!=' ,null)->distinct()->orderByRaw('name')->groupBy('email')->firstOrFail();
        $user = User::all();
        return $this->sendResponse('Success', 'ini daftar user', $user, 200);
    }
    public function pengurus_1()
    {
    }
    public function pengurus_2()
    {
    }
}
