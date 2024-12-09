<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class FiliadoService
{
    public function __construct(private Database $db) {
    }

    public function create(array $formData)
    {
        $formatedDate = "{$formData['birthDate']} 00:00:00";

        $this->db->query(
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
                "nome" => $formData['nome'],
                "cpf" => $formData['cpf'],
                "rg" => $formData['rg'],
                "birthDate" => $formatedDate,
                "company" => $formData['company'],
                "position" => $formData['position'],
                "status" => $formData['status'],
                "phone" => $formData['phone'],
                "cellphone" => $formData['cellphone']

            ]
        );
    }

    public function getAllFiliados(int $length, int $offset) {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'nome' => "%{$searchTerm}%"
        ];

        $filiados = $this->db->query(
            "SELECT *, DATE_FORMAT(flo_birthDate, '%d/%m/%Y') AS formatted_birthDate,
            DATE_FORMAT(flo_lastUpdate, '%d/%m/%Y as %H:%m:%s') AS formatted_lastUpdate
            FROM `flo_filiado`
            WHERE flo_name LIKE :nome
            LIMIT {$length} OFFSET {$offset}",
        $params
        )->findAll();

        $filiadoCount = $this->db->query(
            "SELECT COUNT(*) FROM `flo_filiado`
            WHERE flo_name LIKE :nome",
            $params
        )->count();

        return [$filiados, $filiadoCount];
    }

}