<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class CsrfTokenMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $oView)
    {
    }

    public function process(callable $loNext)
    {
        $_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));

        $this->oView->addGlobal('sCsrfToken', $_SESSION['token']);

        $loNext();
    }
}