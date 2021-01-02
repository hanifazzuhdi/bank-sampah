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
            'email'         => 'required',
            'phone_number'  => 'required',
            'password'      => 'required',
            'address'       => 'required',
        ]);

        $data['password'] = Hash::make(request('password'));
        $data['role_id']  = 1;

        User::create($data);

        alert()->success('Success', 'Data Berhasil dibuat');
        return back();
    }

    public function blacklist()
    {
        $user = User::onlyTrashed()->get();

        return view('nasabah.trash', compact('user'));
    }

    public function softDelete($id)
    {
        $user = User::findOrfail($id);

        $user->delete();

        alert()->success('Success', 'Data Berhasil diblacklist');
        return back();
    }

    public function restore($id)
    {
        $User = User::onlyTrashed()->where('id', $id);
        $User->restore();
        return $this->trash()->with(['success' => 'user dikembalikan']);
    }

    public function delete($id)
    {
        $User = User::onlyTrashed()->where('id', $id);
        $User->forceDelete();
        return $this->trash()->with(['success' => 'user dihapus permanen']);
    }
}
