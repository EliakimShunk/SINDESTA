<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{

    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException('A sessao ja esta ativa.');
        }

        if (headers_sent($filename, $line)) {
            throw new SessionException(
                "Header ja foi enviado. 
                Considere ativar output buffering. Dados recebidos de {$filename} - Linha {$line}");
        }

        session_start();

        $next();

        session_write_close();
    }
}