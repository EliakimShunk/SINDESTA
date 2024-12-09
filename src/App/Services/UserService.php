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

        session_regenerate_id();

        $_SESSION['user'] = $this->db->id();
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

        $_SESSION['user'] = $user['usr_id'];
    }

    public function getAllUsers()
    {

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

}