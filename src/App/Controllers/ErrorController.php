<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class ErrorController
{
    public function __construct(private TemplateEngine $oView)
    {
    }

    public function notFound()
    {
        echo $this->oView->render("errors/not-found.php");
    }
}