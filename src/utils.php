<?php

use JetBrains\PhpStorm\NoReturn;

function is_post_request(): bool {
    return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}

#[NoReturn] function json_response(string $message, int $code = 400): void {
    http_response_code($code);
    echo json_encode(array('status' => $code, 'message' => $message));
    exit($code);
}

#[NoReturn] function redirect(string $path): void {
    header('Location: ' . $path);
    exit();
}

