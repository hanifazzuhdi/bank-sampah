<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function gett()
    {
        $user = User::all();
        if (empty($user)) {
            return response('silakan login terlebih dahulu bos');
        }
        return $this->sendResponse('Success', 'ini dia user', $user, 200);
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (empty($user)) {
            return response('silakan login terlebih dahulu bos');
        }
        return $this->sendResponse('Success', 'ini dia profil anda bos', $user, 200);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'phone_number'  => 'required|string|min:8',
            'name'          => 'required'
        ]);

        if ($request->avatar) {
            $image = cloudinary()->upload(request()->file('avatar')->getRealPath(), [
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ],
                'crop' => 'limit'
            ])->getSecurePath();
        }

        $user = User::where('id', Auth::user()->id)->first();

        $user->name = request('name') ?? $user->name;
        $user->avatar = request('avatar') ? $image : $user->avatar;

        $user->phone_number = $request->phone_number;
        // $user->address = $request->address;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();
        return $this->sendResponse('Success', 'profile berhasil di update Bos', $user, 200);
    }

    public function change(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (!empty($user)) {
            if (password_verify($request->password, $user->password)) {
                $user->password = $request->password_change;
                if (!empty($request->password_change)) {
                    $user->password = Hash::make($request->password_change);
                }
                $user->update();
                return $this->sendResponse('Success', 'password berhasil di ganti Bos', $user, 200);
            } else {
                return $this->sendResponse('Error', 'masukan password lama dengan benar bos', null, 400);
            }
        }
    }
}
