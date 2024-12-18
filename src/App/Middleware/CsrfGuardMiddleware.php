<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class CsrfGuardMiddleware implements MiddlewareInterface
{
    public function process(callable $loNext)
    {
        $sRequestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $aValidMethods = ['POST', 'PATCH', 'DELETE'];

        if (!in_array($sRequestMethod, $aValidMethods)) {
            $loNext();
            return;
        }

        if ($_SESSION['token'] !== $_POST['token']) {
            redirectTo('/');
        }

        unset($_SESSION['token']);

        $loNext();
    }
}