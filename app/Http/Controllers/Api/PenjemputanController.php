<?php

namespace App\Http\Controllers\Api;

use App\Model\Penjemputan;
use App\Http\Controllers\Controller;

class PenjemputanController extends Controller
{
    public function index()
    {
        $permintaan = Penjemputan::with('user')->get();

        if ($permintaan == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }

        return $this->sendResponse('Success', 'ini dia daftar permintaan jemput bos', $permintaan, 200);
    }

    public function terima()
    {
        $permintaan = Penjemputan::with('user')->where('status', 1)->get();

        if ($permintaan == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }

        return $this->sendResponse('Success', 'ini dia daftar permintaan yang diterima bos', $permintaan, 200);
    }

    public function selesai()
    {
        $permintaan = Penjemputan::with('user')->where('status', 2)->get();

        if ($permintaan == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }

        return $this->sendResponse('Success', 'ini dia daftar permintaan yang sudah dijemput bos', $permintaan, 200);
    }

    public function penolakan()
    {
        $permintaan = Penjemputan::with('user')->where('status', 3)->get();

        if ($permintaan == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }

        return $this->sendResponse('Success', 'ini dia daftar penolakan bos', $permintaan, 200);
    }

    public function konfirmasiPenjemputan(Penjemputan $penjemputan)
    {
        $penjemputan->update([
            'status'    => 1
        ]);

        return $this->sendResponse('Success', 'Barang Berhasil dijemput', $penjemputan, 200);
    }

    public function tolak(Penjemputan $penjemputan)
    {
        $penjemputan->update([
            'status'    => 3
        ]);

        return $this->sendResponse('Success', 'permintaan anda tolak', $penjemputan, 200);
    }
}
