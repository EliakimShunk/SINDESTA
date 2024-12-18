<?php

declare(strict_types=1);

namespace App\Models;

class Filiado
{
    private ?int $iId;
    private string $sNome;
    private string $sCpf;
    private string $sRg;
    private string $sBirthDate;
    private string $sCompany;
    private string $sPosition;
    private string $sStatus;
    private string $sPhone;
    private string $sCellphone;
    private ?string $sLastUpdate;

    public function __construct(
        string $sNome,
        string $sCpf,
        string $sRg,
        string $sBirthDate,
        string $sCompany,
        string $sPosition,
        string $sStatus,
        string $sPhone,
        string $sCellphone,
        ?int $iId = null,
        ?string $sLastUpdate = null
    ) {
        $this->iId = $iId;
        $this->sNome = $sNome;
        $this->sCpf = $sCpf;
        $this->sRg = $sRg;
        $this->sBirthDate = $sBirthDate;
        $this->sCompany = $sCompany;
        $this->sPosition = $sPosition;
        $this->sStatus = $sStatus;
        $this->sPhone = $sPhone;
        $this->sCellphone = $sCellphone;
        $this->sLastUpdate = $sLastUpdate;
    }

    // Getters e Setters
    public function getId(): ?int
    {
        return $this->iId;
    }

    public function getNome(): string
    {
        return $this->sNome;
    }

    public function getCpf(): string
    {
        return $this->sCpf;
    }

    public function getRg(): string
    {
        return $this->sRg;
    }

    public function getBirthDate(): string
    {
        return $this->sBirthDate;
    }

    public function getCompany(): string
    {
        return $this->sCompany;
    }

    public function getPosition(): string
    {
        return $this->sPosition;
    }

    public function getStatus(): string
    {
        return $this->sStatus;
    }

    public function getPhone(): string
    {
        return $this->sPhone;
    }

    public function getCellphone(): string
    {
        return $this->sCellphone;
    }

    public function getLastUpdate(): ?string
    {
        return $this->sLastUpdate;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->iId,
            'nome' => $this->sNome,
            'cpf' => $this->sCpf,
            'rg' => $this->sRg,
            'birthDate' => $this->sBirthDate,
            'company' => $this->sCompany,
            'position' => $this->sPosition,
            'status' => $this->sStatus,
            'phone' => $this->sPhone,
            'cellphone' => $this->sCellphone,
            'lastUpdate' => $this->sLastUpdate,
        ];
    }

    public static function fromArray(array $aData): self
    {
        return new self(
            $aData['nome'],
            $aData['cpf'],
            $aData['rg'],
            $aData['birthDate'],
            $aData['company'],
            $aData['position'],
            $aData['status'],
            $aData['phone'],
            $aData['cellphone'],
            $aData['id'],
            $aData['lastUpdate']
        );
    }
}
