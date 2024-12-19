<?php

declare(strict_types=1);

namespace Framework\Exceptions;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(public array $aErrors, int $iCode = 422)
    {
        parent::__construct(code: $iCode);
    }
}