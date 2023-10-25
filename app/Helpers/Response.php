<?php

if (! function_exists('response_success')) {
    function response_success($message = 'Success', $additional_contents = [])
    {
        $response = response()->json(
            array_merge(['message' => $message, 'status' => 200], $additional_contents),
            200
        );

        return $response->original;
    }
}

if (! function_exists('response_error')) {
    function response_error($message = "Something Wen't wrong", $additional_contents = [])
    {
        $response = response()->json(
            array_merge(['message' => $message, 'status' => 404], $additional_contents),
            404
        );

        return $response->original;
    }
}
