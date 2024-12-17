<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    private int $id;
    private string $username;
    private string $lastUpdate;
    private int $isAdmin;

    public function __construct(
        int $id,
        string $username,
        string $lastUpdate,
        int $isAdmin
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->lastUpdate = $lastUpdate;
        $this->isAdmin = $isAdmin;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    public function getIsAdmin(): int
    {
        return $this->isAdmin;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'lastUpdate' => $this->lastUpdate,
            'isAdmin' => $this->isAdmin
        ];
    }
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['username'],
            $data['lastUpdate'],
            $data['isAdmin']
        );
    }
}