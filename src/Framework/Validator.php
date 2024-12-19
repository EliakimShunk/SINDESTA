<?php

declare(strict_types=1);

namespace Framework;

use Framework\Contracts\RuleInterface;
use Framework\Exceptions\ValidationException;

class Validator
{
    private array $aRules = [];

    public function add(string $sAlias, RuleInterface $oRule)
    {
        $this->aRules[$sAlias] = $oRule;
    }
    public function validate(array $aFormData, array $aFields)
    {
        $aErrors = [];
        foreach ($aFields as $sFieldName => $aRules) {
            foreach ($aRules as $sRule) {
                $aRuleParams = [];

                if (str_contains($sRule, ':')) {
                    [$sRule, $aRuleParams] = explode(':', $sRule);
                    $aRuleParams = explode(',', $aRuleParams);
                }

                $oRuleValidator = $this->aRules[$sRule];

                if ($oRuleValidator->validate($aFormData, $sFieldName, $aRuleParams)) {
                    continue;
                }

                $aErrors[$sFieldName][] = $oRuleValidator->getMessage(
                    $aFormData,
                    $sFieldName,
                    $aRuleParams);
            }
        }
         if (count($aErrors)) {
            throw new ValidationException($aErrors);
        }
    }
}