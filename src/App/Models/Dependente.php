<?php

declare(strict_types=1);

namespace App\Models;

class Dependente
{
    private ?int $iId;
    private int $iFiliadoId;
    private string $sNome;
    private string $sBirthDate;
    private string $sRelationship;

    public function __construct(
        ?int $iId,
        int $iFiliadoId,
        string $sNome,
        string $sBirthDate,
        string $sRelationship
    ) {
        $this->iId = $iId ?? null;
        $this->iFiliadoId = $iFiliadoId;
        $this->sNome = $sNome;
        $this->sBirthDate = $sBirthDate;
        $this->sRelationship = $sRelationship;
    }

    public function getId(): ?int
    {
        return $this->iId;
    }

    public function getFiliadoId(): int
    {
        return $this->iFiliadoId;
    }

    public function getNome(): string
    {
        return $this->sNome;
    }

    public function getBirthDate(): string
    {
        return $this->sBirthDate;
    }

    public function getRelationship(): string
    {
        return $this->sRelationship;
    }
    public function toArray(): array {
        return [
            'id' => $this->iId,
            'flo_id' => $this->iFiliadoId,
            'nome' => $this->sNome,
            'birthDate' => $this->sBirthDate,
            'relationship' => $this->sRelationship
        ];
    }
    public static function fromArray(array $aData): self {
        return new self(
            $aData['id'] ?? null,
            $aData['flo_id'],
            $aData['nome'],
            $aData['birthDate'],
            $aData['relationship']
        );
    }
}