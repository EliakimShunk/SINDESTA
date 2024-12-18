<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    CelularFormatRule,
    CpfFormatRule,
    RequiredRule,
    TelefoneFormatRule,
    InRule,
    MatchRule,
    LengthMaxRule,
    NumericRule,
    DateFormatRule};

class ValidatorService
{
    private Validator $oValidator;
    public function __construct()
    {
        $this->oValidator = new Validator();

        $this->oValidator->add('required', new RequiredRule());
        $this->oValidator->add('in', new InRule());
        $this->oValidator->add('match', new MatchRule());
        $this->oValidator->add('lengthMax', new LengthMaxRule());
        $this->oValidator->add('numeric', new NumericRule());
        $this->oValidator->add('dateFormat', new DateFormatRule());
        $this->oValidator->add('cpf', new CpfFormatRule());
        $this->oValidator->add('celular', new CelularFormatRule());
        $this->oValidator->add('telefone', new TelefoneFormatRule());
    }

    public function validateRegister(array $aFormData)
    {
        $this->oValidator->validate($aFormData, [
            'usuario' => ['required', 'lengthMax:46'],
            'password' => ['required', 'lengthMax:256'],
            'confirmPassword' => ['required', 'match:password'],
            'isAdmin' => ['required']
        ]);
    }
    public function validateLogin(array $aFormData)
    {
        $this->oValidator->validate($aFormData, [
            'usuario' => ['required'],
            'password' => ['required']

        ]);
    }
    public function validateFiliado(array $aFormData) {
        $this->oValidator->validate($aFormData, [
            'nome' => ['required', 'lengthMax:51'],
            'cpf' => ['required', 'cpf', 'lengthMax:15'],
            'rg' => ['required', 'lengthMax:13'],
            'birthDate' => ['required', 'dateFormat:Y-m-d'],
            'company' => ['required', 'lengthMax:46'],
            'position' => ['required', 'lengthMax:46'],
            'status' => ['required', 'lengthMax:46'],
            'phone' => ['required', 'telefone', 'lengthMax:16'],
            'cellphone' => ['required', 'celular', 'lengthMax:16']
        ]);
    }
    public function validateFiliadoEdit(array $aFormData) {

        $this->oValidator->validate($aFormData, [
            'company' => ['required', 'lengthMax:46'],
            'position' => ['required', 'lengthMax:46'],
            'status' => ['required', 'lengthMax:46']
        ]);

    }
    public function validateUserEdit(array $aFormData) {
        $this->oValidator->validate($aFormData, [
            'usuario' => ['required', 'lengthMax:46']
        ]);
    }
    public function validateDependente(array $aFormData) {
        $this->oValidator->validate($aFormData, [
            'nome' => ['required', 'lengthMax:46'],
            'birthDate' => ['required', 'dateFormat:Y-m-d'],
            'relationship' => ['required', 'lengthMax:46']
        ]);
    }
    public function validateDependenteEdit(array $aFormData) {
        $this->oValidator->validate($aFormData, [
            'nome' => ['required', 'lengthMax:46']
        ]);
    }
}