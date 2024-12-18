<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    private ?int $iId = null;
    private string $sUsername;
    private ?string $sLastUpdate = null;
    private int $iIsAdmin;

    public function __construct(
        ?int $iId,
        string $sUsername,
        ?string $sLastUpdate,
        int $iIsAdmin
    ) {
        $this->iId = $iId ?? null;
        $this->sUsername = $sUsername;
        $this->sLastUpdate = $sLastUpdate ?? null;
        $this->iIsAdmin = $iIsAdmin;
    }

    public function getId(): ?int
    {
        return $this->iId;
    }

    public function getUsername(): string
    {
        return $this->sUsername;
    }

    public function getLastUpdate(): ?string
    {
        return $this->sLastUpdate;
    }

    public function getIsAdmin(): int
    {
        return $this->iIsAdmin;
    }

    public function toArray(): array {
        return [
            'id' => $this->iId,
            'username' => $this->sUsername,
            'lastUpdate' => $this->sLastUpdate,
            'isAdmin' => $this->iIsAdmin
        ];
    }
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['usuario'],
            $data['lastUpdate'] ?? null,
            $data['isAdmin']
        );
    }
}