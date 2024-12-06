<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db) {
    }

    public function isEmailTaken(string $email) {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => 'Este email ja esta sendo utilizado.']);

        }
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
            "INSERT INTO users (email, password, age, country, social_media_url)
                   VALUES (:email, :password, :age, :country, :url)",
            [
                'email' => $formData['email'],
                'password' => $password,
                'age' => $formData['age'],
                'country' => $formData['country'],
                'url' => $formData['socialMediaURL']
            ]
        );

        session_regenerate_id();

        $_SESSION['user'] = $this->db->id();
    }
    public function createUser(array $formData) {

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
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']
        ])->find();

        $passwordsMatch = password_verify(
            $formData['password'], $user['password'] ?? ''
        );
        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Credenciais invalidas.']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['ID'];
    }
    public function loginUser(array $formData)
    {
        $user = $this->db->query("SELECT * FROM usr_usuario WHERE usr_username = :username", [
            'username' => $formData['usuario']
        ])->find();

        $passwordsMatch = password_verify(
            $formData['password'], $user['password'] ?? ''
        );
        if (!$user || !$passwordsMatch) {
            throw new ValidationException(['password' => ['Credenciais invalidas.']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['usr_id'];
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