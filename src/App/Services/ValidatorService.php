<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    CelularFormatRule,
    CpfFormatRule,
    RequiredRule,
    RgFormatRule,
    TelefoneFormatRule,
    EmailRule,
    MinRule,
    InRule,
    UrlRule,
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
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('url', new UrlRule());
        $this->validator->add('match', new MatchRule());
        $this->validator->add('lengthMax', new LengthMaxRule());
        $this->validator->add('numeric', new NumericRule());
        $this->validator->add('dateFormat', new DateFormatRule());
        $this->validator->add('cpf', new CpfFormatRule());
        $this->validator->add('celular', new CelularFormatRule());
        $this->validator->add('telefone', new TelefoneFormatRule());
    }

    public function validateRegisterOld(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'age' => ['required', 'min:18'],
            'country' => ['required', 'in:USA,Canada,Mexico'],
            'socialMediaURL' => ['required', 'url'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'tos' => ['required'],
            'usuario' => ['required'],
            'isAdmin' => ['required']
        ]);
    }
    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'usuario' => ['required'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'isAdmin' => ['required']
        ]);
    }
    public function validateLoginOld(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'password' => ['required']

        ]);
    }
    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'usuario' => ['required'],
            'password' => ['required']

        ]);
    }
    public function validateTransaction(array $formData) {
        $this->validator->validate($formData, [
            'description' => ['required', 'lengthMax:255'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'dateFormat:Y-m-d']

        ]);
    }
    public function validateFiliado(array $formData) {
        $this->validator->validate($formData, [
            'nome' => ['required'],
            'cpf' => ['required', 'cpf'],
            'rg' => ['required'],
            'birthDate' => ['required', 'dateFormat:Y-m-d'],
            'company' => ['required'],
            'position' => ['required'],
            'status' => ['required'],
            'phone' => ['required', 'telefone'],
            'cellphone' => ['required', 'celular']
        ]);
    }
    public function validateFiliadoEdit(array $formData) {

        $this->validator->validate($formData, [
            'company' => ['required'],
            'position' => ['required'],
            'status' => ['required']
        ]);

    }
    public function validateUserEdit(array $formData) {
        $this->validator->validate($formData, [
            'usuario' => ['required']
        ]);
    }
    public function validateDependente(array $formData) {
        $this->validator->validate($formData, [
            'nome' => ['required'],
            'birthDate' => ['required', 'dateFormat:Y-m-d'],
            'relationship' => ['required']
        ]);
    }
    public function validateDependenteEdit(array $formData) {
        $this->validator->validate($formData, [
            'nome' => ['required'],
        ]);
    }
}