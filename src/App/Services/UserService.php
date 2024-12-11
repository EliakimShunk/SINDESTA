<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db) {
    }
    public function isUsernameTaken(string $username) {
        $usernameCount = $this->db->query(
            "SELECT COUNT(*) FROM usr_usuario WHERE usr_username = :usuario",
            [
                'usuario' => $username
            ]
        )->count();

        if ($usernameCount > 0) {
            throw new ValidationException(['username' => 'Este nome de usuario ja esta sendo utilizado.']);

        }
    }
    public function create(array $formData) {

        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "INSERT INTO usr_usuario (usr_username, usr_password, usr_is_admin)
                   VALUES (:usuario, :password, :isAdmin)",
            [
                'usuario' => $formData['usuario'],
                'password' => $password,
                'isAdmin' => $formData['isAdmin']
            ]
        );
    }

    public function getAllUsers(int $length, int $offset)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'usuario' => "%{$searchTerm}%"
        ];

        $usuarios = $this->db->query(
            "SELECT *, DATE_FORMAT(usr_lastUpdate, '%d/%m/%Y as %H:%i:%s') AS formatted_lastUpdate
            FROM `usr_usuario`
            WHERE usr_username LIKE :usuario
            LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $usuarioCount = $this->db->query(
            "SELECT COUNT(*) FROM `usr_usuario`
            WHERE usr_username LIKE :usuario",
            $params
        )->count();

        return [$usuarios, $usuarioCount];

    }
    public function getUser(string $id) {
        return $this->db->query(
            "SELECT *
            FROM `usr_usuario`
            WHERE usr_id = :id",
            [
                'id' => $id
            ])->find();
    }

    public function update(array $formData, int $id) {
        $currentTime = new \DateTimeImmutable('now', new \DateTimeZone('America/Bahia'));
        $currentTime = $currentTime->format('Y-m-d H:i:s');

        $this->db->query(
            "UPDATE usr_usuario
                  SET `usr_username` = :usuario,
                      `usr_lastUpdate` = :lastUpdate
                  WHERE usr_id = :id",
            [
                'usuario' => $formData['usuario'],
                'lastUpdate' => $currentTime,
                'id' => $id
            ]
        );

    }
    
    public function login(array $formData)
    {
        $user = $this->db->query("SELECT * FROM usr_usuario WHERE usr_username = :usuario", [
            'usuario' => $formData['usuario']
        ])->find();

        $passwordsMatch = password_verify(
            $formData['password'], $user['usr_password'] ?? ''
        );
        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Credenciais invalidas.']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['usr_is_admin'];
    }

    public function logout() {
        session_destroy();

        $params = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    public function delete(int $id) {
        $this->db->query(
            "DELETE FROM usr_usuario 
                   WHERE usr_id = :id",
            [
                'id' => $id
            ]
        );
    }

}