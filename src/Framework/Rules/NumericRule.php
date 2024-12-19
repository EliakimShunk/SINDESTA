<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class NumericRule implements RuleInterface
{
    public function validate(array $aData, string $sField, array $aParams): bool
    {
        return is_numeric($aData[$sField]);

    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return "Apenas numeros sao permitidos.";

    }
}