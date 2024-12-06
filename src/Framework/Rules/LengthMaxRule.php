<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class LengthMaxRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (empty($params[0])) {
            throw new InvalidArgumentException('Limite maximo nao especificado.');
        }

        $length = (int) $params[0];

        return strlen($data[$field]) < $length;

    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Excede o limite maximo de {$params[0]} caracteres.";

    }
}