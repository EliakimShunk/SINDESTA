<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{
    private PDO $oConnection;
    private PDOStatement $oStmt;
    public function __construct(string $sDriver, array $aConfig, string $sUsername, string $sPassword)
    {
        $aConfig = http_build_query(data:$aConfig, arg_separator: ';');

        $sDsn = "$sDriver:$aConfig";

        try {
            $this->oConnection = new PDO($sDsn, $sUsername, $sPassword, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $oE) {
            die("Nao foi possivel se conectar ao banco de dados.");
        }

    }

    public function query(string $sQuery, array $aParams = []): Database
    {
        $this->oStmt = $this->oConnection->prepare($sQuery);

        $this->oStmt->execute($aParams);

        return $this;
    }

    public function count() {
        return $this->oStmt->fetchColumn();
    }

    public function find()
    {
        return $this->oStmt->fetch();
    }

    public function findAll()
    {
        return $this->oStmt->fetchAll();
        
    }
}