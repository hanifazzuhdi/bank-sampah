<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 1)->get();
        return view('pages.nasabah', compact('users'));
    }

    public function store()
    {
        $data = request()->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'phone_number'  => 'required',
            'password'      => 'required',
            'address'       => 'required',
        ]);

        $data['password'] = Hash::make(request('password'));
        $data['role_id']  = 1;

        User::create($data);

        alert()->success('Success', 'Data Berhasil Dibuat');
        return back();
    }

    public function blacklist()
    {
        $users = User::onlyTrashed()->get();

        return view('pages.blacklist', compact('users'));
    }

    public function softDelete($id)
    {
        $user = User::findOrfail($id);

        $user->delete();

        alert()->success('Success', 'Data Berhasil Diblacklist');
        return back();
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();

        alert()->success('Success', 'Data Berhasil Dipulihkan');
        return back();
    }

    public function delete($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        $user->forceDelete();

        alert()->success('Success', 'Data Berhasil Dihapus');
        return back();
    }
}
