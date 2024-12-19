<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class InRule implements RuleInterface
{

    public function validate(array $aData, string $sField, array $aParams): bool
    {
        return in_array($aData[$sField], $aParams);
    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return "Opcao invalida selecionada.";
    }
}