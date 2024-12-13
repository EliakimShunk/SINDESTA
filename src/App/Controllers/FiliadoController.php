<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{FiliadoService, ValidatorService};
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

    public function editView(array $params)
    {
        $filiado = $this->filiadoService->getFiliado(
            $params['filiado']
        );
        if (!$filiado) {
            redirectTo('/');
        }
        echo $this->view->render("filiado/edit.php", [
            'filiado' => $filiado
        ]);
    }
    public function edit(array $params) {
        $filiado = $this->filiadoService->getFiliado(
            $params['filiado']
        );

        if (!$filiado) {
            redirectTo('/');
        }
        $this->validatorService->validateFiliadoEdit($_POST);

        $this->filiadoService->update($_POST, $filiado['flo_id']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function delete(array $params) {
        $this->filiadoService->delete((int) $params['filiado']);

        redirectTo('/');
    }
}