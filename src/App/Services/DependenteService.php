<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class DependenteService
{
    public function __construct(private Database $db)
    {
    }

    public function create(array $formData)
    {
        $this->db->query(
            "INSERT INTO `dpe_dependente` (
                              `flo_id`, 
                              `dpe_name`, 
                              `dpe_birthDate`, 
                              `dpe_relationship`) 
            VALUES (:filiado_id, 
                    :dpe_name, 
                    :dpe_birthDate, 
                    :dpe_relationship)",
            [
                'filiado_id' => $formData['filiado_id'],
                'dpe_name' => $formData['dpe_name'],
                'dpe_birthDate' => $formData['dpe_birthDate'],
                'dpe_relationship' => $formData['dpe_relationship']
            ]
        );
    }
    public function getDependentes(string $id) {
        return $this->db->query(
            "SELECT *, DATE_FORMAT(dpe_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `dpe_dependente`
            WHERE flo_id = :id",
            [
                'id' => $id
            ])->findAll();
    }

    public function update(array $formData, string $id) {
        $this->db->query(
            "UPDATE `dpe_dependente` 
            SET `dpe_name` = :dpe_name
            WHERE dpe_id = :id",
            [
                'dpe_name' => $formData['dpe_name'],
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