<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db)
    {
    }

    public function create(array $formData) {

        $formatedDate = "{$formData['date']} 00:00:00";
        $this->db->query(
            "INSERT INTO transactions (user_ID, description, amount, date)
                   VALUES (:user_ID, :description, :amount, :date)",
            [
                'user_ID' => $_SESSION['user'],
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formatedDate
            ]
        );
    }

    public function getUserTransactions(int $length, int $offset)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params =             [
            'user_ID' => $_SESSION['user'],
            'description' => "%{$searchTerm}%"
        ];

        $transactions = $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') AS formatted_date
                   FROM transactions 
                   WHERE user_ID = :user_ID
                   AND description LIKE :description
                   LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $transactionCount = $this->db->query(
            "SELECT COUNT(*)
                   FROM transactions 
                   WHERE user_ID = :user_ID
                   AND description LIKE :description",
            $params
        )->count();

        return [$transactions, $transactionCount];
    }
}