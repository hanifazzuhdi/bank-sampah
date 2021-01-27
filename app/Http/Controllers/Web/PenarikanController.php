<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Keuangan;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{
    public function index()
    {
        $User = User::all();
        return view('penarikan.index', compact('User'));
    }
    public function tarik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kredit' => 'integer|required',
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        }
        $saldo = Keuangan::latest()->first('saldo');
        //cek dulu saldonya
        if ($saldo < $request->kredit) {
            return $this->sendResponse('Error', 'Saldo anda kurang bos', null, 500);
        }

        //kurangi saldo di keuangan
        $keuangan = Keuangan::create([
            'kredit' => $request->kredit,
            'saldo' => $saldo - $request->kredit,
            'keterangan' => "hasil penjualan ke pengepul"
        ]);

        try {
            $keuangan->save();
            return $this->sendResponse('Success', 'berhasil menjual sampah masyarakat', $keuangan, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('Error', 'Gagal menjual sampah masyarakat', null, 500);
        }
    }
}
