<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface RuleInterface
{
    public function validate(array $aData, string $sField, array $aParams): bool;

    public function getMessage(array $aData, string $sField, array $aParams): string;
}