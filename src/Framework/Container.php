<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $aDefinitions = [];
    private array $aResolved = [];

    public function addDefinitions(array $aNewDefinitions) {
        $this->aDefinitions = [...$this->aDefinitions, ...$aNewDefinitions];
    }

    public function resolve(string $sClassName)
    {
        $oReflectionClass = new ReflectionClass($sClassName);

        if (!$oReflectionClass->isInstantiable()) {
            throw new ContainerException("A classe \"{$sClassName}\" nao pode ser instanciada.");
        }

        $oConstructor = $oReflectionClass->getConstructor();


        if (!$oConstructor) {
            return new $sClassName;
        }

        $loParams = $oConstructor->getParameters();


        if (count($loParams) === 0) {
            return new $sClassName;
        }

        $loDependencies = [];

        foreach ($loParams as $oParam) {
            $sName = $oParam->getName();
            $oType = $oParam->getType();

            if (!$oType) {
                throw new ContainerException(
                    "Nao foi possivel encontrar a classe {$sClassName}, 
                    porque o parâmetro {$sName} não possui uma indicação de tipo.");
            }

            if (!$oType instanceof ReflectionNamedType || $oType->isBuiltin()) {
                throw new ContainerException(
                    "Nao foi possivel encontrar a classe {$sClassName}, 
                    porque o nome do parametro eh invalido.");
            }
            $loDependencies[] = $this->get($oType->getName());

        }
        return $oReflectionClass->newInstanceArgs($loDependencies);
    }

    public function get(string $sId)
    {
        if (!array_key_exists($sId, $this->aDefinitions)) {
            throw new ContainerException(
                "A classe {$sId} nao existe no container."
            );
        }

        if (array_key_exists($sId, $this->aResolved)) {
            return $this->aResolved[$sId];
        }
        $loFactory = $this->aDefinitions[$sId];
        $aDependency = $loFactory($this);

        $this->aResolved[$sId] = $aDependency;

        return $aDependency;
    }
}