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
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->add('required', new RequiredRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('match', new MatchRule());
        $this->validator->add('lengthMax', new LengthMaxRule());
        $this->validator->add('numeric', new NumericRule());
        $this->validator->add('dateFormat', new DateFormatRule());
        $this->validator->add('cpf', new CpfFormatRule());
        $this->validator->add('celular', new CelularFormatRule());
        $this->validator->add('telefone', new TelefoneFormatRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'usuario' => ['required', 'lengthMax:46'],
            'password' => ['required', 'lengthMax:256'],
            'confirmPassword' => ['required', 'match:password'],
            'isAdmin' => ['required']
        ]);
    }
    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'usuario' => ['required'],
            'password' => ['required']

        ]);
    }
    public function validateFiliado(array $formData) {
        $this->validator->validate($formData, [
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
    public function validateFiliadoEdit(array $formData) {

        $this->validator->validate($formData, [
            'company' => ['required', 'lengthMax:46'],
            'position' => ['required', 'lengthMax:46'],
            'status' => ['required', 'lengthMax:46']
        ]);

    }
    public function validateUserEdit(array $formData) {
        $this->validator->validate($formData, [
            'usuario' => ['required', 'lengthMax:46']
        ]);
    }
    public function validateDependente(array $formData) {
        $this->validator->validate($formData, [
            'nome' => ['required', 'lengthMax:46'],
            'birthDate' => ['required', 'dateFormat:Y-m-d'],
            'relationship' => ['required', 'lengthMax:46']
        ]);
    }
    public function validateDependenteEdit(array $formData) {
        $this->validator->validate($formData, [
            'nome' => ['required', 'lengthMax:46']
        ]);
    }
}