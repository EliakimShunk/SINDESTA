<?php

declare(strict_types=1);

use Framework\{TemplateEngine, Database, Container};
use App\Config\Paths;
use App\Services\{
    DependenteService,
    FiliadoService,
    ValidatorService,
    UserService};

return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
    ValidatorService::class => fn() => new ValidatorService(),
    Database::class => fn() => new Database($_ENV['DB_DRIVER'], [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'dbname' => $_ENV['DB_NAME']
    ], $_ENV['DB_USER'], $_ENV['DB_PASS']),
    UserService::class => function (Container $oContainer) {
        $oDb = $oContainer->get(Database::class);

        return new UserService($oDb);
    },
    FiliadoService::class => function (Container $oContainer) {
        $oDb = $oContainer->get(Database::class);

        return new FiliadoService($oDb);
    },
    DependenteService::class => function (Container $oContainer) {
        $oDb = $oContainer->get(Database::class);

        return new DependenteService($oDb);
    }
];