<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 5)->get();

        return view('pages.karyawan', compact('users'));
    }

    public function update($id)
    {
        $data = request()->validate([
            'name'  => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);

        User::find($id)->update($data);

        alert()->success('Success', 'Data Berhasil Diubah');
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
        }

        echo json_encode($data);
    }
}
