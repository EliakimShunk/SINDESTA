<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Models\User;

class UserService
{
    public function __construct(private Database $oDb) {
    }
    public function isUsernameTaken(string $sUsername) {
        $iUsernameCount = $this->oDb->query(
            "SELECT COUNT(*) FROM usr_usuario WHERE usr_username = :usuario",
            [
                'usuario' => $sUsername
            ]
        )->count();

        if ($iUsernameCount > 0) {
            throw new ValidationException(['username' => 'Este nome de usuario ja esta sendo utilizado.']);

        }
    }
    public function create(array $aFormData) {
        $aFormData['isAdmin'] = (int) $aFormData['isAdmin'];
        $oUser = User::fromArray($aFormData);

        $sPassword = password_hash($aFormData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->oDb->query(
            "INSERT INTO usr_usuario (usr_username, usr_password, usr_is_admin)
                   VALUES (:usuario, :password, :isAdmin)",
            [
                'usuario' => $oUser->getUsername(),
                'password' => $sPassword,
                'isAdmin' => $oUser->getIsAdmin()
            ]
        );
    }

    public function getAllUsers(int $iLength, int $iOffset)
    {
        $sSearchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $aParams = [
            'usuario' => "%{$sSearchTerm}%"
        ];

        $aUsuariosData = $this->oDb->query(
            "SELECT *, DATE_FORMAT(usr_lastUpdate, '%d/%m/%Y as %H:%i:%s') AS formatted_lastUpdate
            FROM `usr_usuario`
            WHERE usr_username LIKE :usuario
            LIMIT {$iLength} OFFSET {$iOffset}",
            $aParams
        )->findAll();

        $iUsuarioCount = $this->oDb->query(
            "SELECT COUNT(*) FROM `usr_usuario`
            WHERE usr_username LIKE :usuario",
            $aParams
        )->count();

        $aUsuarios = [];
        foreach ($aUsuariosData as $aUsuarioData) {
            $oUsuario = new User(
                iId: $aUsuarioData['usr_id'],
                sUsername: $aUsuarioData['usr_username'],
                sLastUpdate: $aUsuarioData['formatted_lastUpdate'],
                iIsAdmin: $aUsuarioData['usr_is_admin']
            );

            $aUsuarioArray = $oUsuario->toArray();

            $aUsuarios[] = $aUsuarioArray;
        }

        return [$aUsuarios, $iUsuarioCount];

    }
    public function getUser(string $sId) {
        return $this->oDb->query(
            "SELECT *
            FROM `usr_usuario`
            WHERE usr_id = :id",
            [
                'id' => $sId
            ])->find();
    }

    public function update(array $aFormData, int $iId) {
        $oCurrentTime = new \DateTimeImmutable('now', new \DateTimeZone('America/Bahia'));
        $oCurrentTime = $oCurrentTime->format('Y-m-d H:i:s');

        $this->oDb->query(
            "UPDATE usr_usuario
                  SET `usr_username` = :usuario,
                      `usr_lastUpdate` = :lastUpdate
                  WHERE usr_id = :id",
            [
                'usuario' => $aFormData['usuario'],
                'lastUpdate' => $oCurrentTime,
                'id' => $iId
            ]
        );

    }
    
    public function login(array $aFormData)
    {
        $aUser = $this->oDb->query("SELECT * FROM usr_usuario WHERE usr_username = :usuario", [
            'usuario' => $aFormData['usuario']
        ])->find();

        $bPasswordsMatch = password_verify(
            $aFormData['password'], $aUser['usr_password'] ?? ''
        );
        if (!$aUser || !$bPasswordsMatch) {
            throw new ValidationException(['password' => ['Credenciais invalidas.']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $aUser['usr_is_admin'];

    }

    public function logout() {
        session_destroy();

        $aParams = session_get_cookie_params();
        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $aParams["path"],
            $aParams["domain"],
            $aParams["secure"],
            $aParams["httponly"]
        );
    }

    public function delete(int $iId) {
        $this->oDb->query(
            "DELETE FROM usr_usuario 
                   WHERE usr_id = :id",
            [
                'id' => $iId
            ]
        );
    }

}