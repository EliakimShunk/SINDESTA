<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $aGlobalTemplateData = [];
    public function __construct(private string $sBasePath) {
    }
    public function render(string $sTemplate, array $aData = []) {
        extract($aData, EXTR_SKIP);
        extract($this->aGlobalTemplateData, EXTR_SKIP);

        ob_start();

        include $this->resolve($sTemplate);

        $sOutput = ob_get_contents();

        ob_end_clean();

        return $sOutput;
    }

    public function resolve(string $sPath) {
        return "{$this->sBasePath}/{$sPath}";
    }

    public function addGlobal(string $sKey, mixed $mValue) {
        $this->aGlobalTemplateData[$sKey] = $mValue;
    }
}