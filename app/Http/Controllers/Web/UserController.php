<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 1)->get();
        return view('pages.nasabah', compact('users'));
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
        return $this->trash()->with(['success' => 'user dihapus permanen']);
    }
}
