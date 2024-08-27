<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Api extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseJSON($data, $result = FALSE, $code = 400, $message = NULL)
    {
        $result = [
            'result' => $result,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ];

        return response()->json($result, $code);
    }
}
