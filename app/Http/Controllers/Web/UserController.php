<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $User = User::all();
        return view('nasabah.index', compact('User'));
    }
    public function detail()
    {
        return view('nasabah.detail');
    }
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return $this->index()->with(['success' => 'user dihapus']);
        }
        return $this->sendResponse('Error', 'Gagal menghapus data', null, 500);
    }
    public function trash()
    {
        $User = User::onlyTrashed()->get();
        return view('nasabah.trash', compact('User'));
    }
    public function restore($id)
    {
        $User = User::onlyTrashed()->where('id', $id);
        $User->restore();
        return $this->trash()->with(['success' => 'user dikembalikan']);
    }
    public function hapus_permanen($id)
    {
        $User = User::onlyTrashed()->where('id', $id);
        $User->forceDelete();
        return $this->trash()->with(['success' => 'user dikembalikan']);
    }   
}