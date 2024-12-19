<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class RequiredRule implements RuleInterface
{

    public function validate(array $aData, string $sField, array $aParams): bool
    {
        return !empty($aData[$sField]);
    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return "Este campo é obrigatório.";
    }
}