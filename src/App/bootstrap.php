<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\Paths;
use Dotenv\Dotenv;

use function App\Config\{registerRoutes, registerMiddleware};

$oDotenv = Dotenv::createImmutable(Paths::ROOT);
$oDotenv->load();

$loApp = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($loApp);
registerMiddleware($loApp);

return $loApp;