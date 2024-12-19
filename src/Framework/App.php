<?php

declare(strict_types=1);

namespace Framework;

use Framework\Router;

class App
{
    private Router $oRouter;
    private Container $oContainer;

    public function __construct(string $sContainerDefinitionsPath = null)
    {
        $this->oRouter = new Router();
        $this->oContainer = new Container();

        if ($sContainerDefinitionsPath) {
            $loContainerDefinitions = include $sContainerDefinitionsPath;
            $this->oContainer->addDefinitions($loContainerDefinitions);
        }
    }

    public function run()
    {
        $sPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $sMethod = $_SERVER['REQUEST_METHOD'];

        $this->oRouter->dispatch($sPath, $sMethod, $this->oContainer);

    }

    public function get(string $sPath, array $aController): App
    {
        $this->oRouter->add('get', $sPath, $aController);
        return $this;
    }

    public function post(string $sPath, array $aController): App
    {
        $this->oRouter->add('post', $sPath, $aController);
        return $this;
    }

    public function addMiddleware(string $sMiddleware)
    {
        $this->oRouter->addMiddleware($sMiddleware);
    }

    public function add(string $sMiddleware) {
        $this->oRouter->addRouteMiddleware($sMiddleware);
    }

    public function delete(string $sPath, array $aController): App
    {
        $this->oRouter->add('DELETE', $sPath, $aController);

        return $this;
    }

    public function setErrorHandler(array $aController) {
        $this->oRouter->setErrorHandler($aController);
    }
}