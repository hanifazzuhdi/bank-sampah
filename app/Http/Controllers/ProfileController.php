<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Hash;
use GuzzleHttp\Client;

class ProfileController extends Controller
{
    public function index()
	{
		$user = User::where('id', Auth::user()->id)->first();
		if (Empty($user)) {
			return response('silakan login terlebih dahulu bos');
		}
		return $this->sendResponse('Succes', 'ini dia profil anda bos', $user, 500);
		// return view('profile.index', compact('user'));
	}
    public function update(Request $request)
    {
        $this->validate($request, [
            'password'  => 'requiredconfirmed',
            'phone_number'  => 'string',
            
        ]);
        $image = null;

        if ($request->image) {
            $img = base64_encode(file_get_contents($request->image));
            $client = new Client();
            $res = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $img,
                    'format' => 'json',
                ]
            ]);
            $array = json_decode($res->getBody()->getContents());
            $image = $array->image->file->resource->chain->image;
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->avatar = $image;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();
        return $this->sendResponse('Success', 'profile berhasil di update Bos', $user, 500);
    }
    public function change(Request $request)
    {
        $this->validate($request, [
            'password'  => 'requiredconfirmed',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $user->password = $request->password_change;
        $user->update();
        if (!empty($request->password_change)) {
            $user->password = Hash::make($request->password_change);
        }
        return $this->sendResponse('Success', 'password berhasil di ganti Bos', $user, 500);
    }
}
