<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class UserController
{
    public function __construct(
        private TemplateEngine $oView,
        private ValidatorService $oValidatorService,
        private UserService $oUserService)
    {
    }

    public function list()
    {
        $iPage = $_GET['p'] ?? 1;
        $iPage = (int) $iPage;
        $iLength = 10;
        $iOffset = ($iPage - 1) * $iLength;
        $mSearchTerm = $_GET['s'] ?? null;

        [$aUsuarios, $iCount] = $this->oUserService->getAllUsers(
            $iLength,
            $iOffset
        );

        $iLastPage = ceil($iCount / $iLength);

        $aPages = $iLastPage ? range(1, $iLastPage) : [];

        $aPageLinks = array_map(
            fn($iPageNum) => http_build_query([
                'p' => $iPageNum,
                's' => $mSearchTerm,
            ]),
            $aPages
        );

        echo $this->oView->render("/usuario/list.php", [
            'usuarios' => $aUsuarios,
            'currentPage' => $iPage,
            'previousPageQuery' => http_build_query([
                'p' => $iPage - 1,
                's' => $mSearchTerm
            ]),
            'lastPage' => $iLastPage,
            'nextPageQuery' => http_build_query([
                'p' => $iPage + 1,
                's' => $mSearchTerm
            ]),
            'pageLinks' => $aPageLinks,
            'searchTerm' => $mSearchTerm
        ]);
    }

    public function editView(array $aParams)
    {
        $aUsuario = $this->oUserService->getUser(
            $aParams['usuario']
        );
        if (!$aUsuario) {
            redirectTo('/');
        }
        echo $this->oView->render("usuario/edit.php", [
            'usuario' => $aUsuario
        ]);
    }
    public function edit(array $aParams) {
        $aUsuario = $this->oUserService->getUser(
            $aParams['usuario']
        );

        if (!$aUsuario) {
            redirectTo('/');
        }
        $this->oValidatorService->validateUserEdit($_POST);

        $this->oUserService->update($_POST, $aUsuario['usr_id']);

        redirectTo($_SERVER['HTTP_REFERER']);
        
    }

    public function delete(array $aParams)
    {
        $this->oUserService->delete((int) $aParams['usuario']);

        redirectTo('/usuario');
        
    }
}