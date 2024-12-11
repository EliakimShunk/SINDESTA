<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController,
    AboutController,
    AuthController,
    FiliadoController,
    TransactionController,
    ReceiptController,
    ErrorController,
    UserController};
use App\Middleware\{AdminRequiredMiddleware, AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app) {
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/cadastrar', [AuthController::class, 'registerView'])->add(AdminRequiredMiddleware::class);
    $app->post('/cadastrar', [AuthController::class, 'register'])->add(AdminRequiredMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/usuario', [UserController::class, 'list'])->add(AdminRequiredMiddleware::class);
    $app->get('/usuario/{usuario}', [UserController::class, 'editView'])->add(AdminRequiredMiddleware::class);
    $app->post('/usuario/{usuario}', [UserController::class, 'edit'])->add(AdminRequiredMiddleware::class);
    $app->delete('/usuario/{usuario}', [UserController::class, 'delete'])->add(AdminRequiredMiddleware::class);
    $app->get('/filiado', [FiliadoController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/filiado', [FiliadoController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/filiado/{filiado}', [FiliadoController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/filiado/{filiado}', [FiliadoController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $app->delete('/filiado/{filiado}', [FiliadoController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}', [TransactionController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction/{transaction}', [TransactionController::class, 'edit'])->add(AuthRequiredMiddleware::class);
    $app->delete('/transaction/{transaction}', [TransactionController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}/receipt', [ReceiptController::class, 'uploadView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction/{transaction}/receipt', [ReceiptController::class, 'upload'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'download'])->add(AuthRequiredMiddleware::class);
    $app->delete('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'delete'])->add(AuthRequiredMiddleware::class);

    $app->setErrorHandler([ErrorController::class, 'notFound']);
}
