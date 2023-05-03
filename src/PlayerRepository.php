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
    public static function add(Player $player): void
    {
        $queryBuilder = DBALConnection::getConnection()->createQueryBuilder();

        $queryBuilder->insert("player")
            ->values([
                "fname" => "?",
                "lname" => "?"
            ])
            ->setParameter(0, $player->fname)
            ->setParameter(1, $player->lname);

        $queryBuilder->executeQuery();


    }
}