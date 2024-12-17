<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Models\Filiado;

class FiliadoService
{
    public function __construct(private Database $db) {
    }

    public function create(array $formData) {
        $filiado = Filiado::fromArray($formData);

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
                'nome' => $filiado->getNome(),
                'cpf' => $filiado->getCpf(),
                'rg' => $filiado->getRg(),
                'birthDate' => "{$filiado->getBirthDate()} 00:00:00",
                'company' => $filiado->getCompany(),
                'position' => $filiado->getPosition(),
                'status' => $filiado->getStatus(),
                'phone' => $filiado->getPhone(),
                'cellphone' => $filiado->getCellphone(),
            ]
        );
    }

    public function getAllFiliados(int $length, int $offset) {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $monthSelect = $_GET['f'] ?? '';
        $filterMonth = "= $monthSelect";
        if ($monthSelect === '') {
            $filterMonth = '!= 0';
        }
        $params = [
            'nome' => "%{$searchTerm}%"
        ];

        $filiadosData = $this->db->query(
            "SELECT *, DATE_FORMAT(flo_birthDate, '%d/%m/%Y') AS formatted_birthDate,
            DATE_FORMAT(flo_lastUpdate, '%d/%m/%Y as %H:%m:%s') AS formatted_lastUpdate
            FROM `flo_filiado`
            WHERE flo_name LIKE :nome
            AND MONTH(flo_birthDate) {$filterMonth}
            LIMIT {$length} OFFSET {$offset}",
        $params
        )->findAll();

        $filiadoCount = $this->db->query(
            "SELECT COUNT(*) FROM `flo_filiado`
            WHERE flo_name LIKE :nome
            AND MONTH(flo_birthDate) {$filterMonth}",
            $params
        )->count();

        $tz = new \DateTimeZone('America/Bahia');

        // Converter os dados em objetos Filiado
        $filiados = [];
        foreach ($filiadosData as $filiadoData) {
            $birthDate = \DateTime::createFromFormat('Y-m-d H:i:s', $filiadoData['flo_birthDate'], $tz);
            $age = $birthDate ? $birthDate->diff(new \DateTime('now', $tz))->y : null;

            $filiado = new Filiado(
                nome: $filiadoData['flo_name'],
                cpf: $filiadoData['flo_cpf'],
                rg: $filiadoData['flo_rg'],
                birthDate: $filiadoData['formatted_birthDate'],
                company: $filiadoData['flo_company'],
                position: $filiadoData['flo_position'],
                status: $filiadoData['flo_status'],
                phone: $filiadoData['flo_phone'],
                cellphone: $filiadoData['flo_cellphone'],
                id: (int) $filiadoData['flo_id'],
                lastUpdate: $filiadoData['formatted_lastUpdate'] ?? null
            );
            // Adiciona a idade calculada diretamente no objeto Filiado
            $filiadoArray = $filiado->toArray();
            $filiadoArray['age'] = $age;

            $filiados[] = $filiadoArray;
        }


        return [$filiados, $filiadoCount];
    }
    public function getFiliado(string $id) {
        return $this->db->query(
            "SELECT *, DATE_FORMAT(flo_birthDate, '%d/%m/%Y') AS formatted_birthDate
            FROM `flo_filiado`
            WHERE flo_id = :id",
            [
                'id' => $id
            ])->find();
    }

    public function update(array $formData, int $id) {
        $currentTime = new \DateTimeImmutable('now', new \DateTimeZone('America/Bahia'));
        $currentTime = $currentTime->format('Y-m-d H:i:s');

        $this->db->query(
            "UPDATE flo_filiado
                  SET `flo_company` = :company,
                      `flo_position` = :position,
                      `flo_status` = :status,
                      `flo_lastUpdate` = :lastUpdate
                  WHERE flo_id = :id",
            [
                'company' => $formData['company'],
                'position' => $formData['position'],
                'status' => $formData['status'],
                'lastUpdate' => $currentTime,
                'id' => $id,
            ]
        );
    }
    public function delete(int $id) {
        $this->db->query(
            "DELETE FROM dpe_dependente 
            WHERE flo_id = :id;
            DELETE FROM flo_filiado 
            WHERE flo_id = :id;",
            [
                'id' => $id
            ]
        );
    }

}