<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use App\Model\Tabungan;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'tabungan');
    }

    public function index()
    {
        $users = User::where('role_id', 1)->get();
        return view('pages.admin.nasabah', compact('users'));
    }

    public function tabungan($id)
    {
        $datas = Tabungan::with('user')->where('user_id', $id)->get();

        $user = User::findOrFail($id);

        return view('pages.tabungan', compact('datas', 'user'));
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

        return view('pages.admin.blacklist', compact('users'));
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
