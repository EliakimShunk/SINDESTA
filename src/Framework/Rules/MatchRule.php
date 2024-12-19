<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MatchRule implements RuleInterface
{
    public function validate(array $aData, string $sField, array $aParams): bool
    {
        $sFieldOne = $aData[$sField];
        $sFieldTwo = $aData[$aParams[0]];

        return $sFieldOne === $sFieldTwo;
    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return "Nao corresponde ao campo {$aParams[0]}.";
    }
}