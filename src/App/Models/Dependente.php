<?php

declare(strict_types=1);

namespace App\Models;

class Dependente
{
    private int $id;
    private int $filiadoId;
    private string $nome;
    private string $birthDate;
    private string $relationship;

    public function __construct(
        int $id,
        int $filiadoId,
        string $nome,
        string $birthDate,
        string $relationship
    ) {
        $this->id = $id;
        $this->filiadoId = $filiadoId;
        $this->nome = $nome;
        $this->birthDate = $birthDate;
        $this->relationship = $relationship;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFiliadoId(): int
    {
        return $this->filiadoId;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getRelationship(): string
    {
        return $this->relationship;
    }
    public function toArray(): array {
        return [
            'id' => $this->id,
            'filiado_id' => $this->filiadoId,
            'nome' => $this->nome,
            'birth_date' => $this->birthDate,
            'relationship' => $this->relationship
        ];
    }
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['filiado_id'],
            $data['nome'],
            $data['birth_date'],
            $data['relationship']
        );
    }
}