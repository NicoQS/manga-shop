<?php

namespace App\Traits;

trait HttpsResponse
{
    public function success($data, $message = null, $code = 200) {
        $response = [
            'status' => 'Request was succesful.',
            'message' => $message,
            'data' => $data['items'] ?? $data
        ];

        if (isset($data['links'])) {
            $response['links'] = $data['links'];
        }

        if (isset($data['meta'])) {
            $response['meta'] = $data['meta'];
        }

        return response()->json($response, $code);
    }
    public function error($data, $message = null, $code = 500) {
        return response()->json([
            'status' => 'Error has occurred...',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /* public function noLoggedIn(){
        return $this->error([
            'message' => 'El usuario no ha iniciado sesion.',
            'data' => [],
            'code' => 403
        ]);
    } */
}
