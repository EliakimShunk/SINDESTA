<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\FiliadoService;
use App\Services\TransactionService;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class FiliadoController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private FiliadoService $filiadoService
    ) {
    }
    public function createView()
    {
        echo $this->view->render("filiado/create.php");
    }
    public function create() {
        $this->validatorService->validateFiliado($_POST);

        $this->filiadoService->create($_POST);

        redirectTo('/');
    }

}