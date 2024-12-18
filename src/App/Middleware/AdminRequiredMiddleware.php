<?php
declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class AdminRequiredMiddleware implements MiddlewareInterface
{
    public function process(callable $loNext)
    {
        if (($_SESSION['user'] !== 1)) {
            redirectTo('/');
        }

        $loNext();
    }
}