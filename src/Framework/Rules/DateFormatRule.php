<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class DateFormatRule implements RuleInterface
{
    public function validate(array $aData, string $sField, array $aParams): bool
    {
        $aParsedDate = date_parse_from_format($aParams[0], $aData[$sField]);

        return $aParsedDate['error_count'] === 0 && $aParsedDate['warning_count'] === 0;

    }

    public function getMessage(array $aData, string $sField, array $aParams): string
    {
        return "Data invalida.";

    }
}