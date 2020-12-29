<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            return view('admin.index');
        } else {
            return redirect('/');
        } 
    }
}
