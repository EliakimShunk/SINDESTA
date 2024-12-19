<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class CpfFormatRule implements RuleInterface
{

    public function validate(array $aData, string $sField, array $aParams): bool
    {
        return (bool) preg_match('#^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$#', $aData[$sField]);
    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return 'CPF invalido.';
    }
}