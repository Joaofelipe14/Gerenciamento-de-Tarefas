<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;

/**
 * @OA\Info(title="Documentation TaskApi", version="0.1")
 ** @OA\SecurityScheme(
 *    securityScheme="bearerAuth",
 *    in="header",
 *    name="Authorization",
 *    type="http",
 *    scheme="bearer",
 *    bearerFormat="JWT",
 * )
 */

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
