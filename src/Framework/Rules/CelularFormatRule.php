<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class CelularFormatRule implements RuleInterface
{

    public function validate(array $data, string $field, array $params): bool
    {
        return (bool) preg_match('#^\([0-9]{2}\) 9?[0-9]{4}\-[0-9]{4}$#', $data[$field]);
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return 'Numero de celular invalido';
    }
}