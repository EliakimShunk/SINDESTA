<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $aRoutes = [];
    private array $aMiddlewares = [];
    private array $aErrorHandler;

    public function add(string $sMethod, string $sPath, array $aController)
    {
        $sPath = $this->normalizePath($sPath);

        $sRegexPath = preg_replace('#{[^/]+}#', '([^/]+)', $sPath);

        $this->aRoutes[] = [
            'path' => $sPath,
            'method' => strtoupper($sMethod),
            'controller' => $aController,
            'middlewares' => [],
            'regexPath' => $sRegexPath
        ];

    }

    private function normalizePath(string $sPath): string
    {
        $sPath = trim($sPath, '/');
        $sPath = "/{$sPath}/";
        $sPath = preg_replace('#[/]{2,}#', '/', $sPath);
        return $sPath;
    }

    public function dispatch(string $sPath, string $sMethod, Container $oContainer = null)
    {
        $sPath = $this->normalizePath($sPath);
        $sMethod = strtoupper($_POST['_method'] ?? $sMethod);

        foreach ($this->aRoutes as $aRoute) {
            if (
                !preg_match("#^{$aRoute['regexPath']}$#", $sPath, $aParamValues)
                || $aRoute['method'] !== $sMethod
            ) {
                continue;
            }

            array_shift($aParamValues);

            preg_match_all('#{([^/]+)}#', $aRoute['path'], $aParamKeys);

            $aParamKeys = $aParamKeys[1];

            $aParams = array_combine($aParamKeys, $aParamValues);


            [$sClass, $sFunction] = $aRoute['controller'];

            $mControllerInstance = $oContainer
                ? $oContainer->resolve($sClass)
                : new $sClass;

            $fnAction = fn() => $mControllerInstance->{$sFunction}($aParams);


            $aAllMiddleware = [...$aRoute['middlewares'], ...$this->aMiddlewares];

            foreach ($aAllMiddleware as $sMiddleware) {
                $mMiddlewareInstance = $oContainer
                    ? $oContainer->resolve($sMiddleware)
                    : new $sMiddleware;
                $fnAction = fn() => $mMiddlewareInstance->process($fnAction);
            }

            $fnAction();

            return;
        }
        $this->dispatchNotFound($oContainer);
    }

    public function addMiddleware(string $sMiddleware)
    {
        $this->aMiddlewares[] = $sMiddleware;
    }

    public function addRouteMiddleware(string $sMiddleware) {
        $mLastRouteKey = array_key_last($this->aRoutes);
        $this->aRoutes[$mLastRouteKey]['middlewares'][] = $sMiddleware;
    }

    public function setErrorHandler(array $aController) {
        $this->aErrorHandler = $aController;
    }

    public function dispatchNotFound(?Container $oContainer) {
        [$sClass, $sFunction] = $this->aErrorHandler;

        $mControllerInstance = $oContainer
            ? $oContainer->resolve($sClass)
            : new $sClass;

        $fnAction = fn() => $mControllerInstance->{$sFunction}();

        foreach ($this->aMiddlewares as $sMiddleware) {
            $mMiddlewareInstance = $oContainer
                ? $oContainer->resolve($sMiddleware)
                : new $sMiddleware;
            $fnAction = fn() => $mMiddlewareInstance->process($fnAction);
        }
        $fnAction();
    }
}