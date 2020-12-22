<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function sendResponse($status = 'failed', $msg = 'data not found', $data = null, $code = 404)
    {
        return response([
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        ], $code);
    }
}
