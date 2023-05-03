<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Lukas\WebtCoreDoctrineDbal\Game;
use Lukas\WebtCoreDoctrineDbal\PlayerRepository;
use Lukas\WebtCoreDoctrineDbal\Player;


$loader = new \Twig\Loader\FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);

//..
$connectionParams = [
    'dbname' => 'rps',
    'user' => 'rps',
    'password' => 'rps',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);
$queryBuilder = $conn->createQueryBuilder();

$queryBuilder = $queryBuilder
    ->select("concat(p1.fname,' ', p1.lname) as nameone", "concat(p2.fname,' ', p2.lname) as nametwo", "moveone", "movetwo", "date")
    ->from("game", "g")
    ->join("g", "player", "p1", "g.fk_playerone = p1.pk_player_id")
    ->join("g", "player", "p2", "g.fk_playertwo = p2.pk_player_id");

function determineWinner(string $symbol1, string $symbol2): int
{
    if ($symbol1 == $symbol2) {
        return 0;
    }

    $match = substr($symbol1, 0, 1) . substr($symbol2, 0, 1);

    $winner1 = ["RS", "PR", "SP"];

    if (in_array($match, $winner1)) {
        return 1;
    } else {
        return 2;
    }
}

if (isset($_GET["fname1"])) {
    addEntry($_GET["fname1"], $_GET["lname1"], $_GET["fname2"], $_GET["lname2"], $_GET["move1"], $_GET["move2"], $queryBuilder);
}

// $queryBuilder->select

/**
 * @throws \Doctrine\DBAL\Exception
 */
function addEntry($fname1, $lname1, string $fname2, $lname2, $move1, $move2, QueryBuilder $qb): void
{
    PlayerRepository::add(new Player($fname1, $lname1));
}


function removeEntry()
{

}

$result = $queryBuilder->executeQuery()->fetchAllAssociative();

$games = [];


foreach ($result as $row) {
    $winner = determineWinner($row['moveone'], $row['movetwo']);
    $games[] = new Game($row['nameone'], $row['nametwo'], $row['moveone'], $row['movetwo'], $row['date'], $winner);
}

$template = $twig->load('template.html');

echo $template->render(['games' => $games]);



