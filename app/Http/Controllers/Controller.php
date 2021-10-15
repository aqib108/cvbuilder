<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function error($message,  $var = array())
    {
        dd($var);
        $data['status'] = 204;
        $data['icon'] = 'error';
        $data['message'] = $message;
        $data['userdata'] = $var;
        return response()->json($data);
    }
    function success($message, $var = array())
    {
        $data['status'] = 200;
        $data['icon'] = 'success';
        $data['message'] = $message;
        $data['userdata'] = $var;
        return response()->json($data);

    }
}
