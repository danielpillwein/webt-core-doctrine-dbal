<?php

namespace Lukas\WebtCoreDoctrineDbal;

use Doctrine\DBAL\Exception;

class PlayerRepository
{
    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public static function add(Player $player): Player
    {
        $con = DBALConnection::getConnection();
        $queryBuilder = $con->createQueryBuilder();

        $queryBuilder->insert("player")
            ->values([
                "fname" => "?",
                "lname" => "?"
            ])
            ->setParameter(0, $player->fname)
            ->setParameter(1, $player->lname);

        $queryBuilder->executeQuery();

        // setzt den Primary-Key des Spielerobjekts
        $player->setPlayerId($con->lastInsertId());

        return $player;
    }
}