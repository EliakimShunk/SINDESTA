<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Dependente;
use Framework\Database;

class DependenteService
{
    public function __construct(private Database $db)
    {
    }

    public function create(array $formData)
    {
        $dependente = Dependente::fromArray($formData);
        $this->db->query(
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
                'id' => $dependente->getId(),
                'nome' => $dependente->getNome(),
                'birthDate' => $dependente->getBirthDate(),
                'relationship' => $dependente->getRelationship()
            ]
        );
    }
    public function getAllDependentes(array $filiado) {
        $dependentesData = $this->db->query(
            "SELECT *, DATE_FORMAT(dpe_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `dpe_dependente`
            WHERE flo_id = :id",
            [
                'id' => $filiado['flo_id']
            ])->findAll();
        $dependentes = [];
        foreach ($dependentesData as $dependenteData) {
            $dependente = new Dependente(
                id: $dependenteData['dpe_id'],
                filiadoId: $dependenteData['flo_id'],
                nome: $dependenteData['dpe_name'],
                birthDate: $dependenteData['formatted_birthDate'],
                relationship: $dependenteData['dpe_relationship']
            );
            $dependenteArray = $dependente->toArray();
            $dependentes[] = $dependenteArray;
        }

        return $dependentes;
    }
    public function getDependente(string $id) {
        return $this->db->query(
            "SELECT *, DATE_FORMAT(dpe_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `dpe_dependente`
            WHERE dpe_id = :id",
            [
                'id' => $id
            ]
        )->find();
    }

    public function update(array $formData, string $id) {
        $this->db->query(
            "UPDATE `dpe_dependente` 
            SET `dpe_name` = :dpe_name
            WHERE dpe_id = :id",
            [
                'dpe_name' => $formData['nome'],
                'id' => $id
            ]
        );
    }

    public function delete(int $id) {
        $this->db->query(
            "DELETE FROM `dpe_dependente`
            WHERE dpe_id = :id",
            [
                'id' => $id
            ]
        );
    }

}