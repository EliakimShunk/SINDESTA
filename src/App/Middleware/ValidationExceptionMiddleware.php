<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $loNext)
    {
        try {
            $loNext();
        } catch (ValidationException $e) {
            $aOldFormData = $_POST;

            $aExcludedFields = ['password', 'confirmPassword'];
            $aFormatedFormData = array_diff_key(
                $aOldFormData,
                array_flip($aExcludedFields)
            );

            $_SESSION['aErrors'] = $e->errors;
            $_SESSION['aOldFormData'] = $aFormatedFormData;

            $sReferer = $_SERVER['HTTP_REFERER'];
            redirectTo($sReferer);
        }

    }
}