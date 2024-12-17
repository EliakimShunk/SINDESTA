<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{
    TemplateDataMiddleware,
    ValidationExceptionMiddleware,
    SessionMiddleware,
    FlashMiddleware,
    CsrfTokenMiddleware,
    CsrfGuardMiddleware};

function registerMiddleware(App $loApp)
{

    $loApp->addMiddleware(CsrfGuardMiddleware::class);
    $loApp->addMiddleware(CsrfTokenMiddleware::class);
    $loApp->addMiddleware(TemplateDataMiddleware::class);
    $loApp->addMiddleware(ValidationExceptionMiddleware::class);
    $loApp->addMiddleware(FlashMiddleware::class);
    $loApp->addMiddleware(SessionMiddleware::class);
}