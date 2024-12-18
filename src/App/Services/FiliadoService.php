<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Models\Filiado;

class FiliadoService
{
    public function __construct(private Database $oDb) {
    }

    public function create(array $aFormData) {
        $oFiliado = Filiado::fromArray($aFormData);

        $this->oDb->query(
            "INSERT INTO `flo_filiado` (
                           `flo_name`, 
                           `flo_cpf`, 
                           `flo_rg`, 
                           `flo_birthDate`, 
                           `flo_company`, 
                           `flo_position`, 
                           `flo_status`, 
                           `flo_phone`, 
                           `flo_cellphone`) 
            VALUES (
                    :nome,
                    :cpf,
                    :rg,
                    :birthDate,
                    :company,
                    :position,
                    :status,
                    :phone,
                    :cellphone) ",
            [
                'nome' => $oFiliado->getNome(),
                'cpf' => $oFiliado->getCpf(),
                'rg' => $oFiliado->getRg(),
                'birthDate' => "{$oFiliado->getBirthDate()} 00:00:00",
                'company' => $oFiliado->getCompany(),
                'position' => $oFiliado->getPosition(),
                'status' => $oFiliado->getStatus(),
                'phone' => $oFiliado->getPhone(),
                'cellphone' => $oFiliado->getCellphone(),
            ]
        );
    }

    public function getAllFiliados(int $iLength, int $iOffset) {
        $sSearchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $sMonthSelect = $_GET['f'] ?? '';
        $sFilterMonth = "= $sMonthSelect";
        if ($sMonthSelect === '') {
            $sFilterMonth = '!= 0';
        }
        $aParams = [
            'nome' => "%{$sSearchTerm}%"
        ];

        $aFiliadosData = $this->oDb->query(
            "SELECT *, DATE_FORMAT(flo_birthDate, '%d/%m/%Y') AS formatted_birthDate,
            DATE_FORMAT(flo_lastUpdate, '%d/%m/%Y as %H:%m:%s') AS formatted_lastUpdate
            FROM `flo_filiado`
            WHERE flo_name LIKE :nome
            AND MONTH(flo_birthDate) {$sFilterMonth}
            LIMIT {$iLength} OFFSET {$iOffset}",
        $aParams
        )->findAll();

        $iFiliadoCount = $this->oDb->query(
            "SELECT COUNT(*) FROM `flo_filiado`
            WHERE flo_name LIKE :nome
            AND MONTH(flo_birthDate) {$sFilterMonth}",
            $aParams
        )->count();

        $oTz = new \DateTimeZone('America/Bahia');

        $aFiliados = [];
        foreach ($aFiliadosData as $aFiliadoData) {
            $oBirthDate = \DateTime::createFromFormat('Y-m-d H:i:s', $aFiliadoData['flo_birthDate'], $oTz);
            $iAge = $oBirthDate ? $oBirthDate->diff(new \DateTime('now', $oTz))->y : null;

            $oFiliado = new Filiado(
                sNome: $aFiliadoData['flo_name'],
                sCpf: $aFiliadoData['flo_cpf'],
                sRg: $aFiliadoData['flo_rg'],
                sBirthDate: $aFiliadoData['formatted_birthDate'],
                sCompany: $aFiliadoData['flo_company'],
                sPosition: $aFiliadoData['flo_position'],
                sStatus: $aFiliadoData['flo_status'],
                sPhone: $aFiliadoData['flo_phone'],
                sCellphone: $aFiliadoData['flo_cellphone'],
                iId: (int) $aFiliadoData['flo_id'],
                sLastUpdate: $aFiliadoData['formatted_lastUpdate'] ?? null
            );

            $aFiliadoArray = $oFiliado->toArray();
            $aFiliadoArray['age'] = $iAge;

            $aFiliados[] = $aFiliadoArray;
        }

        return [$aFiliados, $iFiliadoCount];
    }
    public function getFiliado(string $sId) {
        return $this->oDb->query(
            "SELECT *, DATE_FORMAT(flo_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `flo_filiado`
            WHERE flo_id = :id",
            [
                'id' => $sId
            ])->find();
    }

    public function update(array $aFormData, int $iId) {
        $oCurrentTime = new \DateTimeImmutable('now', new \DateTimeZone('America/Bahia'));
        $oCurrentTime = $oCurrentTime->format('Y-m-d H:i:s');

        $this->oDb->query(
            "UPDATE flo_filiado
                  SET `flo_company` = :company,
                      `flo_position` = :position,
                      `flo_status` = :status,
                      `flo_lastUpdate` = :lastUpdate
                  WHERE flo_id = :id",
            [
                'company' => $aFormData['company'],
                'position' => $aFormData['position'],
                'status' => $aFormData['status'],
                'lastUpdate' => $oCurrentTime,
                'id' => $iId,
            ]
        );
    }
    public function delete(int $iId) {
        $this->oDb->query(
            "DELETE FROM dpe_dependente 
            WHERE flo_id = :id;
            DELETE FROM flo_filiado 
            WHERE flo_id = :id;",
            [
                'id' => $iId
            ]
        );
    }

}