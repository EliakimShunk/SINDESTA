<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{
    public function __construct(
        private TemplateEngine $oView,
        private ValidatorService $oValidatorService,
        private UserService $oUserService)
    {
    }

    public function registerView()
    {
        echo $this->oView->render('register.php');
    }


    public function register()
    {
        $this->oValidatorService->validateRegister($_POST);

        $this->oUserService->isUsernameTaken($_POST['usuario']);

        $this->oUserService->create($_POST);

        redirectTo('/usuario');
    }
    public function loginView()
    {
        echo $this->oView->render('login.php');
    }

    public function login()
    {
        $this->oValidatorService->validateLogin($_POST);

        $this->oUserService->login($_POST);

        redirectTo('/');
    }

    public function logout() {
        $this->oUserService->logout();
        redirectTo('/login');
    }
}