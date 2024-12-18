<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Dependente;
use Framework\Database;

class DependenteService
{
    public function __construct(private Database $oDb)
    {
    }

    public function create(array $aFormData)
    {
        $aFormData['flo_id'] = (int) $aFormData['flo_id'];
        $aDependente = Dependente::fromArray($aFormData);
        $this->oDb->query(
            "INSERT INTO `dpe_dependente` (
                              `flo_id`, 
                              `dpe_name`, 
                              `dpe_birthDate`, 
                              `dpe_relationship`) 
            VALUES (:flo_id, 
                    :dpe_name, 
                    :dpe_birthDate, 
                    :dpe_relationship)",
            [
                'flo_id' => $aDependente->getFiliadoId(),
                'dpe_name' => $aDependente->getNome(),
                'dpe_birthDate' => $aDependente->getBirthDate(),
                'dpe_relationship' => $aDependente->getRelationship()
            ]
        );
    }
    public function getAllDependentes(array $aFiliado) {
        $aDependentesData = $this->oDb->query(
            "SELECT *, DATE_FORMAT(dpe_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `dpe_dependente`
            WHERE flo_id = :id",
            [
                'id' => $aFiliado['flo_id']
            ])->findAll();
        $aDependentes = [];
        foreach ($aDependentesData as $aDependenteData) {
            $oDependente = new Dependente(
                iId: $aDependenteData['dpe_id'],
                iFiliadoId: $aDependenteData['flo_id'],
                sNome: $aDependenteData['dpe_name'],
                sBirthDate: $aDependenteData['formatted_birthDate'],
                sRelationship: $aDependenteData['dpe_relationship']
            );
            $aDependenteArray = $oDependente->toArray();
            $aDependentes[] = $aDependenteArray;
        }

        return $aDependentes;
    }
    public function getDependente(string $sId) {
        return $this->oDb->query(
            "SELECT *, DATE_FORMAT(dpe_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `dpe_dependente`
            WHERE dpe_id = :id",
            [
                'id' => $sId
            ]
        )->find();
    }

    public function update(array $aFormData, string $sId) {
        $this->oDb->query(
            "UPDATE `dpe_dependente` 
            SET `dpe_name` = :dpe_name
            WHERE dpe_id = :id",
            [
                'dpe_name' => $aFormData['nome'],
                'id' => $sId
            ]
        );
    }

    public function delete(int $sId) {
        $this->oDb->query(
            "DELETE FROM `dpe_dependente`
            WHERE dpe_id = :id",
            [
                'id' => $sId
            ]
        );
    }

}