<?php

namespace Lukas\WebtCoreDoctrineDbal;

use Doctrine\DBAL\Exception;

class GameRepository
{
    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public static function add(Game $game): Game
    {
        $con = DBALConnection::getConnection();
        $queryBuilder = $con->createQueryBuilder();

        $queryBuilder->insert("game")
            ->values([
                "fk_playerOne" => "?",
                "fk_playerTwo" => "?",
                "moveOne" => "?",
                "moveTwo" => "?",
                "date" => "?",
            ])
            ->setParameter(0, $game->player_one->player_id)
            ->setParameter(1, $game->player_two->player_id)
            ->setParameter(2, $game->move_one)
            ->setParameter(3, $game->move_two)
            ->setParameter(4, $game->date);

        $queryBuilder->executeQuery();

        $game->setGameId($con->lastInsertId());

        return $game;
    }

    /**
     * @throws Exception
     */
    public static function getAll(): array {
        $con = DBALConnection::getConnection();

        $queryBuilder = $con->createQueryBuilder();

        $games = [];

        $queryBuilder
            ->select([
                "p1.pk_player_id AS p1_id",
                "p2.pk_player_id AS p2_id",
                "p1.fname AS p1_fname",
                "p2.fname AS p2_fname",
                "p1.lname AS p1_lname",
                "p2.lname AS p2_lname",
                "g.pk_game_id AS game_id",
                "g.moveOne AS p1_move",
                "g.moveTwo AS p2_move",
                "g.date AS date",
            ])
            ->from("game", "g")
            ->join("g", "player", "p1", "g.fk_playerone = p1.pk_player_id")
            ->join("g", "player", "p2", "g.fk_playertwo = p2.pk_player_id");

        $result = $queryBuilder->executeQuery()->fetchAllAssociative();

        foreach ($result as $row) {
            $player1 = new Player($row["p1_id"], $row["p1_fname"], $row["p1_lname"]);
            $player2 = new Player($row["p2_id"], $row["p2_fname"], $row["p2_lname"]);
            $games[] = new Game($row["game_id"], $player1, $player2, $row["p1_move"], $row["p2_move"], $row["date"]);
        }

        return $games;
    }
}