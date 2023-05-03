<?php

namespace Lukas\WebtCoreDoctrineDbal;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

define("CONNECTION_PARAMS", [
    'dbname' => 'rps',
    'user' => 'rps',
    'password' => 'rps',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
]);

class DBALConnection {
    /**
     * @throws Exception
     */
    public static function getConnection()
    {
        return DriverManager::getConnection(CONNECTION_PARAMS);
    }
}
