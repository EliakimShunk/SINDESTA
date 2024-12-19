<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class CelularFormatRule implements RuleInterface
{

    public function validate(array $aData, string $sField, array $aParams): bool
    {
        return (bool) preg_match('#^\([0-9]{2}\) 9?[0-9]{4}\-[0-9]{4}$#', $aData[$sField]);
    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return 'Numero de celular invalido';
    }
}