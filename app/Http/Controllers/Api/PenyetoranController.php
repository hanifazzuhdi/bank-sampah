<?php

namespace App\Http\Controllers\Api;

use App\Model\Jenis;
use App\Model\Penyetoran;
use App\Model\Penjemputan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class PenyetoranController extends Controller
{
    public function store($fee = 0, $id = null)
    {
            $data = request()->validate([
            'jenis_sampah' => 'required',
            'berat'        => 'required',
        ]);

        $harga = Jenis::find(request('jenis_sampah'));

        $data['penghasilan'] = $fee == 0 ? $harga->harga * $data['berat'] : $harga->harga * $data['berat'] - (($harga->harga * $data['berat']) * $fee / 100);

        if ($id != null) {
            $data['user_id'] = $id;
            $this->selesaiPenjemputan($id);
        } else {
            $user_id = User::where('email', request('email'))->firstOrFail();
            $data['user_id'] = $user_id;
        }

        $res = Penyetoran::create($data);

        // update buku tabungan & gudang sampah
        if ($res) {
            SampahController::addSampah($data);
            TransaksiController::addSaldo($data);
        } else {
            $this->sendResponse('Failed', 'Gagal Melakukan Permintaan', null, 400);
        }

        return $this->sendResponse('Success', 'Sampah berhasil disetor', $res, 201);
    }

    public function jemput()
    {
        $data = request()->validate([
            'image'         => 'required',
            'address'       => 'required',
            'phone_number'  => 'required',
            'description'   => 'required',
        ]);

        // Validasi image
        $response = cloudinary()->upload(request('image')->getRealPath())->getSecurePath();

        // input image
        $data['image'] = $response;

        // input user id
        $data['user_id'] = Auth::id();

        $res = Penjemputan::create($data);

        return $this->sendResponse('Success', 'Driver Sedang kelokasi Anda', $res, 200);
    }

    public function historyPenjemputan()
    {
        $data = Penjemputan::where('user_id', Auth::id())->orderBy('status', 'ASC')->get();

        // if (empty($data->array)) return $this->sendResponse();

        return $this->sendResponse('Success', 'History Berhasil dimuat', $data, 200);
    }

    protected function selesaiPenjemputan($id)
    {
        $penjemputan = Penjemputan::find($id);

        return $penjemputan->update([
            'status'    => 2
        ]);
    }
}
