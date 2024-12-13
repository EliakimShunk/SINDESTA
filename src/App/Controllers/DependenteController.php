<?php

namespace App\Controllers;

use App\Services\{DependenteService, FiliadoService, ValidatorService};
use Framework\TemplateEngine;

class DependenteController
{
    public function __construct(
        private TemplateEngine $view,
        private FiliadoService $filiadoService,
        private ValidatorService $validatorService,
        private DependenteService $dependenteService
    ) {
    }

    public function list(array $params) {

        $filiado = $this->filiadoService->getFiliado(
            $params['filiado']
        );
        if (!$filiado) {
            redirectTo('/');
        }

        $dependentes = $this->dependenteService->getAllDependentes(
            $filiado
        );
        if (!$dependentes) {
            redirectTo("/filiado/{$filiado['flo_id']}/dependente");
        } else {
            echo $this->view->render("/dependente/list.php", [
                'filiado' => $filiado,
                'dependentes' => $dependentes]);
        }

    }
    public function createView(array $params) {
        $filiado = $this->filiadoService->getFiliado(
            $params['filiado']
        );
        if (!$filiado) {
            redirectTo('/');
        }
        echo $this->view->render("dependente/create.php", [
            'filiado' => $filiado
        ]);
    }
    public function create() {
        $this->validatorService->validateDependente($_POST);

        $this->dependenteService->create($_POST);

        redirectTo("/filiado/{$_POST['flo_id']}/dependentes");
    }

    public function editView(array $params) {
        $filiado = $this->filiadoService->getFiliado(
            $params['filiado']
        );
        if (!$filiado) {
            redirectTo('/');
        }
        $dependente = $this->dependenteService->getDependente(
            $params['dependente']
        );
        if (!$dependente) {
            redirectTo('/');
        }
        echo $this->view->render("dependente/edit.php", [
            'dependente' => $dependente
        ]);
    }

    public function edit(array $params) {
        $dependente = $this->dependenteService->getDependente(
            $params['dependente']
        );
        $this->validatorService->validateDependenteEdit($_POST);

        $this->dependenteService->update($_POST, $dependente['dpe_id']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }
    public function delete(array $params) {
        $this->dependenteService->delete((int) $params['dependente']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }

}