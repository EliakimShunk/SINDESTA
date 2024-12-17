<?php

declare(strict_types=1);

namespace App\Models;

class Filiado
{
    private int $id;
    private string $nome;
    private string $cpf;
    private string $rg;
    private string $birthDate;
    private string $company;
    private string $position;
    private string $status;
    private string $phone;
    private string $cellphone;
    private string $lastUpdate;

    public function __construct(
        string $nome,
        string $cpf,
        string $rg,
        string $birthDate,
        string $company,
        string $position,
        string $status,
        string $phone,
        string $cellphone,
        int $id = null,
        string $lastUpdate = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->birthDate = $birthDate;
        $this->company = $company;
        $this->position = $position;
        $this->status = $status;
        $this->phone = $phone;
        $this->cellphone = $cellphone;
        $this->lastUpdate = $lastUpdate;
    }

    // Getters e Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getRg(): string
    {
        return $this->rg;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'birthDate' => $this->birthDate,
            'company' => $this->company,
            'position' => $this->position,
            'status' => $this->status,
            'phone' => $this->phone,
            'cellphone' => $this->cellphone,
            'lastUpdate' => $this->lastUpdate,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['nome'],
            $data['cpf'],
            $data['rg'],
            $data['birthDate'],
            $data['company'],
            $data['position'],
            $data['status'],
            $data['phone'],
            $data['cellphone'],
            $data['id'],
            $data['lastUpdate']
        );
    }
}
