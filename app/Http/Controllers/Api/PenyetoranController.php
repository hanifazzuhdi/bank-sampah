<?php

namespace App\Http\Controllers\Api;

use App\Model\Jenis;
use GuzzleHttp\Client;
use App\Model\Penyetoran;
use App\Model\Penjemputan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PenyetoranController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'jenis_sampah' => 'required',
            'berat'        => 'required',
        ]);

        $harga = Jenis::find(request('jenis_sampah'));
        $data['penghasilan'] = $harga->harga * $data['berat'];

        $data['user_id'] = Auth::id();

        // jika ada orang iseng
        abort_if($data['user_id'] != Auth::id(), 403, 'ANDA TIDAK MEMILIKI AKSES KESINI');

        $res = Penyetoran::create($data);

        // update buku tabungan
        if ($res) {
            TransaksiController::addSaldo($data);
        }

        return response([
            'status' => 'success',
            'data'   => $res
        ], 201);
    }

    public function jemput(Client $client)
    {
        $data = request()->validate([
            'image'         => 'required',
            'address'       => 'required',
            'phone_number'  => 'required',
            'description'   => 'required',
            'status'        => 'required',
        ]);

        // Validasi image
        $image = base64_encode(file_get_contents(request('image')));
        $res = $client->request('POST', 'https://freeimage.host/api/1/upload', [
            'form_params' => [
                'key' => '6d207e02198a847aa98d0a2a901485a5',
                'action' => 'upload',
                'source' => $image,
                'format' => 'json'
            ]
        ]);
        $get = $res->getBody()->getContents();
        $hasil = json_decode($get);

        // input image
        $data['image'] = $hasil->image->display_url;

        // input user id
        $data['user_id'] = Auth::id();

        // jika ada orang iseng
        abort_if($data['user_id'] != Auth::id(), 403, 'ANDA TIDAK MEMILIKI AKSES KESINI');

        Penjemputan::create($data);

        return response([
            'status' => 'success',
            'message' => 'Driver Sedang ke Lokasi Abda',
            'data'   => $data
        ]);
    }
}