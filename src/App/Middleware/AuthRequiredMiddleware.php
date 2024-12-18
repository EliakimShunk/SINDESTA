<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class AuthRequiredMiddleware implements MiddlewareInterface
{
    public function process(callable $loNext)
    {
        if (empty($_SESSION['user'])) {
            redirectTo('/login');
        }

        $loNext();
    }
}