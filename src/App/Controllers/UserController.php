<?php

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class UserController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService)
    {
    }

    public function list()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 10;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? null;

        [$usuarios, $count] = $this->userService->getAllUsers(
            $length,
            $offset
        );

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm,
            ]),
            $pages
        );

        echo $this->view->render("/usuario/list.php", [
            'usuarios' => $usuarios,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ]),
            'pageLinks' => $pageLinks,
            'searchTerm' => $searchTerm
        ]);
    }

    public function editView(array $params)
    {
        $usuario = $this->userService->getUser(
            $params['usuario']
        );
        if (!$usuario) {
            redirectTo('/');
        }
        echo $this->view->render("usuario/edit.php", [
            'usuario' => $usuario
        ]);
    }
    public function edit(array $params) {
        $usuario = $this->userService->getUser(
            $params['usuario']
        );

        if (!$usuario) {
            redirectTo('/');
        }
        $this->validatorService->validateUserEdit($_POST);

        $this->userService->update($_POST, $usuario['usr_id']);

        redirectTo($_SERVER['HTTP_REFERER']);
        
    }

    public function delete(array $params)
    {
        $this->userService->delete((int) $params['usuario']);

        redirectTo('/usuario');
        
    }
}