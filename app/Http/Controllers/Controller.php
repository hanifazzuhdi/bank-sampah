<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Send Response Cepat
    public function sendResponse($status = 'Failed', $msg = 'data not found', $data = null, $code = 404)
    {
        return response([
            'status' => $status,
            'message' => $msg,
            'data' => $data
        ], $code);
    }

    // Number Format
    public function saldoFormat($value)
    {
        return number_format($value, 0, ',', '.');
    }

    // Sapa Login
    public function sapa()
    {
        $jam = date('H:i');

        if ($jam >= '03:00' and $jam <= '10:00') {
            $sapa = 'Selamat Pagi ';
        } else if ($jam >= '10:01' and $jam <= '15:00') {
            $sapa = 'Selamat Siang ';
        } else if ($jam >= '15:01' and $jam <= '18:00') {
            $sapa = 'Selamat Sore ';
        } else {
            $sapa = 'Selamat Malam ';
        }

        return $sapa;
    }
}
