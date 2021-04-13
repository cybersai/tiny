<?php

if (!function_exists('json_response')) {
    function json_response(array $data, int $status_code = 200)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
        header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

        header('Content-Type: application/json');
        http_response_code($status_code);
        return json_encode($data);
    }
}

