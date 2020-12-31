<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 5)->get();

        return view('pages.karyawan', compact('users'));
    }

    public function store()
    {
        $data = request()->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'phone_number'  => 'required|min:6',
            'password'  => 'required',
            'role_id'   => 'required',
            'address'   => 'required'
        ]);

        $data['password'] = Hash::make(request('password'));

        User::create($data);

        alert()->success('Success', 'Data Berhasil ditambahkan');
        return back();
    }

    public function update($id)
    {
        $data = request()->validate([
            'name'  => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        User::find($id)->update($data);

        alert()->success('Success', 'Data Berhasil diubah');
        return back();
    }

    // jquery
    public function show($id)
    {
        $data = User::find($id);

        switch (true) {
            case $data->role_id == 4:
                $data->role_id = 'Bendahara';
                break;
            case $data->role_id == 2:
                $data->role_id = 'Pengurus 1';
                break;
            case $data->role_id == 3:
                $data->role_id = 'Pengurus 2';
                break;
            default:
                "Format Salah !";
                break;
        }

        echo json_encode($data);
    }
}
