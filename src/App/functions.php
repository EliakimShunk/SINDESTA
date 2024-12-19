<?php

declare(strict_types=1);

use Framework\Http;

function dd(mixed $mValue) : void {
    echo "<pre>";
    var_dump($mValue);
    echo "</pre>";
    die();
}

function e(mixed $mValue): string {
    return htmlspecialchars((string) $mValue);
}

function redirectTo(string $sPath) {
    header("location: {$sPath}");
    http_response_code(Http::REDIRECT_STATUS_CODE);
    exit;
}