<?php

namespace App\Http\Controllers\Web;

use App\Model\Jenis;
use App\Model\Sampah;
use App\Http\Controllers\Controller;
use App\Model\hargasampah;

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

    public function store()
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
            $response = cloudinary()->upload(request()->file('image')->getRealPath(), [
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ],
                'crop' => 'limit'
            ])->getSecurePath();

            // Get Link Image
            $data['image'] = $response;
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

    public function update($id)
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

            $response = cloudinary()->upload(request()->file('image')->getRealPath(), [
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ],
                'crop' => 'limit'
            ])->getSecurePath();

            // Get Link Image
            $data['image'] = $response;
        }

        Jenis::find($id)->update($data);
        hargasampah::create([
            'jenis' => $data['jenis_sampah'],
            'harga' => $data['harga']
        ]);
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
