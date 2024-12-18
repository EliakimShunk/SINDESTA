<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{

    public function process(callable $loNext)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException('A sessao ja esta ativa.');
        }

        if (headers_sent($sFilename, $sLine)) {
            throw new SessionException(
                "Header ja foi enviado. 
                Considere ativar output buffering. Dados recebidos de {$sFilename} - Linha {$sLine}");
        }

        session_set_cookie_params([
            'secure' => $_ENV['APP_ENV'] === 'production',
            'httponly' => true,
            'samesite' => 'lax'
        ]);

        session_start();

        $loNext();

        session_write_close();
    }
}