<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class CpfFormatRule implements RuleInterface
{

    public function validate(array $data, string $field, array $params): bool
    {
        return (bool) preg_match('#^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$#', $data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return 'CPF invalido.';
    }
}