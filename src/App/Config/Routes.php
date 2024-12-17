<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController,
    DependenteController,
    AuthController,
    FiliadoController,
    ErrorController,
    UserController};
use App\Middleware\{AdminRequiredMiddleware, AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $loApp) {
    $loApp->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $loApp->get('/cadastrar', [AuthController::class, 'registerView'])->add(AdminRequiredMiddleware::class);
    $loApp->post('/cadastrar', [AuthController::class, 'register'])->add(AdminRequiredMiddleware::class);
    $loApp->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $loApp->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $loApp->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $loApp->get('/usuario', [UserController::class, 'list'])->add(AdminRequiredMiddleware::class);
    $loApp->get('/usuario/{usuario}', [UserController::class, 'editView'])->add(AdminRequiredMiddleware::class);
    $loApp->post('/usuario/{usuario}', [UserController::class, 'edit'])->add(AdminRequiredMiddleware::class);
    $loApp->delete('/usuario/{usuario}', [UserController::class, 'delete'])->add(AdminRequiredMiddleware::class);
    $loApp->get('/filiado', [FiliadoController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $loApp->post('/filiado', [FiliadoController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $loApp->get('/filiado/{filiado}', [FiliadoController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $loApp->post('/filiado/{filiado}', [FiliadoController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $loApp->delete('/filiado/{filiado}', [FiliadoController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    $loApp->get('/filiado/{filiado}/dependentes', [DependenteController::class, 'list'])->add(AuthRequiredMiddleware::class);
    $loApp->get('/filiado/{filiado}/dependente', [DependenteController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $loApp->post('/filiado/{filiado}/dependente', [DependenteController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $loApp->get('/filiado/{filiado}/dependente/{dependente}', [DependenteController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $loApp->post('/filiado/{filiado}/dependente/{dependente}', [DependenteController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $loApp->delete('filiado/{filiado}/dependente/{dependente}', [DependenteController::class, 'delete'])->add(AuthRequiredMiddleware::class);

    $loApp->setErrorHandler([ErrorController::class, 'notFound']);
}
