<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class LengthMaxRule implements RuleInterface
{
    public function validate(array $aData, string $sField, array $aParams): bool
    {
        if (empty($aParams[0])) {
            throw new InvalidArgumentException('Limite maximo nao especificado.');
        }

        $iLength = (int) $aParams[0];

        return strlen($aData[$sField]) < $iLength;

    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return "Excede o limite maximo de {$aParams[0]} caracteres.";

    }
}