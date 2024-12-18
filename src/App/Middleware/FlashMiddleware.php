<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class FlashMiddleware implements MiddlewareInterface
{

    public function __construct(private TemplateEngine $oView)
    {
    }

    public function process(callable $loNext)
    {

        $this->oView->addGlobal('aErrors', $_SESSION['aErrors'] ?? []);

        unset($_SESSION['aErrors']);

        $this->oView->addGlobal('aOldFormData', $_SESSION['aOldFormData'] ?? []);

        unset($_SESSION['aOldFormData']);

        $loNext();
    }
}