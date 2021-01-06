<?php

namespace App\Http\Controllers\Web;

use App\Model\Jenis;
use App\Model\Sampah;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class SampahController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('getSampah', 'getGudang', 'show');
    }

    public function getSampah()
    {
        $sampahs = Jenis::paginate(6);

        return view('pages.admin.sampah', compact('sampahs'));
    }

    // for ajax
    public function show($id)
    {
        $data = Jenis::find($id);

        echo json_encode($data);
    }

    public function store(Client $client)
    {
        $data = request()->validate([
            'jenis_sampah' => 'required',
            'harga'        => 'required',
            'warna'        => 'required',
        ]);

        // kondisi name image tidak ada
        if (!request('image')) {
            $data['image'] = request('imageURL');
        } else {
            // kondisi name image ada dan validasi post api image
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

            // Get Link Image
            $data['image'] = $hasil->image->display_url;
        }

        // Create to DB
        $jenis = Jenis::create($data);

        // Create data to table Sampahs
        Sampah::create([
            'jenis_sampah' => $jenis->id,
            'berat'        => 0
        ]);

        alert()->success('Success', 'Data Berhasil Ditambahkan');
        return back();
    }

    public function update($id, Client $client)
    {
        $data = request()->validate([
            'jenis_sampah'  => 'required',
            'harga'         => 'required',
        ]);

        // kondisi name image tidak ada
        if (!request('image')) {
            $data['image'] = request('imageURL');
        } else {
            // kondisi name image ada dan validasi post api image
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

            // Get Link Image
            $data['image'] = $hasil->image->display_url;
        }

        Jenis::find($id)->update($data);

        alert()->success('Success', 'Data Berhasil Diubah');
        return back();
    }

    public function destroy($id)
    {
        Jenis::destroy($id);

        alert()->success('Success', 'Data Berhasil Dihapus');
        return back();
    }

    // Gudang
    public function getGudang()
    {
        $sampahs = Sampah::with(['jenis'])->orderBy('id', 'ASC')->paginate(6);

        return view('pages.admin.gudang', compact('sampahs'));
    }
}
