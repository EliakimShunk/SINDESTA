<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $oView)
    {
    }

    public function process(callable $loNext)
    {
        $this->oView->addGlobal('sTitle', 'Sindicato dos Estagiarios');

        $loNext();
    }
}