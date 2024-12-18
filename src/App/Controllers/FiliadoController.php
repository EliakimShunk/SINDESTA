<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{FiliadoService, ValidatorService};
use Framework\TemplateEngine;

class FiliadoController
{
    public function __construct(
        private TemplateEngine $oView,
        private ValidatorService $oValidatorService,
        private FiliadoService $oFiliadoService
    ) {
    }
    public function createView()
    {
        echo $this->oView->render("filiado/create.php");
    }
    public function create() {
        $this->oValidatorService->validateFiliado($_POST);

        $this->oFiliadoService->create($_POST);

        redirectTo('/');
    }

    public function editView(array $aParams)
    {
        $aFiliado = $this->oFiliadoService->getFiliado(
            $aParams['filiado']
        );
        if (!$aFiliado) {
            redirectTo('/');
        }
        echo $this->oView->render("filiado/edit.php", [
            'aFiliado' => $aFiliado
        ]);
    }
    public function edit(array $aParams) {
        $aFiliado = $this->oFiliadoService->getFiliado(
            $aParams['filiado']
        );

        if (!$aFiliado) {
            redirectTo('/');
        }
        $this->oValidatorService->validateFiliadoEdit($_POST);

        $this->oFiliadoService->update($_POST, $aFiliado['flo_id']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function delete(array $aParams) {
        $this->oFiliadoService->delete((int) $aParams['filiado']);

        redirectTo('/');
    }
}