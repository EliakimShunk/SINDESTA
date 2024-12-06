<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

use Framework\Http;

#[NoReturn] function dd(mixed $value) : void {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function e(mixed $value): string {
    return htmlspecialchars((string) $value);
}

function redirectTo(string  $path) {
    header("location: {$path}");
    http_response_code(Http::REDIRECT_STATUS_CODE);
    exit;
}