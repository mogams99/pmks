<?php 

namespace App\Helpers;

class ResponseHelper
{
    public static function jsonResponse($statusCode, $message, $redirect = null, $data = [])
    {
        $response = ['message' => $message];

        if (!is_null($redirect)) {
            $response['redirect'] = $redirect;
        }

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }
}
?>