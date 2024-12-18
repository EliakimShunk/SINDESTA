<?php

namespace App\Controllers;

use App\Services\{DependenteService, FiliadoService, ValidatorService};
use Framework\TemplateEngine;

class DependenteController
{
    public function __construct(
        private TemplateEngine $oView,
        private FiliadoService $oFiliadoService,
        private ValidatorService $oValidatorService,
        private DependenteService $oDependenteService
    ) {
    }

    public function list(array $aParams) {

        $aFiliado = $this->oFiliadoService->getFiliado(
            $aParams['filiado']
        );
        if (!$aFiliado) {
            redirectTo('/');
        }

        $aDependentes = $this->oDependenteService->getAllDependentes(
            $aFiliado
        );
        if (!$aDependentes) {
            redirectTo("/filiado/{$aFiliado['flo_id']}/dependente");
        } else {
            echo $this->oView->render("/dependente/list.php", [
                'aFiliado' => $aFiliado,
                'aDependentes' => $aDependentes]);
        }

    }
    public function createView(array $aParams) {
        $aFiliado = $this->oFiliadoService->getFiliado(
            $aParams['filiado']
        );
        if (!$aFiliado) {
            redirectTo('/');
        }
        echo $this->oView->render("dependente/create.php", [
            'aFiliado' => $aFiliado
        ]);
    }
    public function create() {
        $this->oValidatorService->validateDependente($_POST);

        $this->oDependenteService->create($_POST);

        redirectTo("/filiado/{$_POST['flo_id']}/dependentes");
    }

    public function editView(array $aParams) {
        $filiado = $this->oFiliadoService->getFiliado(
            $aParams['filiado']
        );
        if (!$filiado) {
            redirectTo('/');
        }
        $dependente = $this->oDependenteService->getDependente(
            $aParams['dependente']
        );
        if (!$dependente) {
            redirectTo('/');
        }
        echo $this->oView->render("dependente/edit.php", [
            'aDependente' => $dependente
        ]);
    }

    public function edit(array $aParams) {
        $dependente = $this->oDependenteService->getDependente(
            $aParams['dependente']
        );
        $this->oValidatorService->validateDependenteEdit($_POST);

        $this->oDependenteService->update($_POST, $dependente['dpe_id']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }
    public function delete(array $aParams) {
        $this->oDependenteService->delete((int) $aParams['dependente']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }

}