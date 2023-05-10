<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use Lukas\WebtCoreDoctrineDbal\Game;
use Lukas\WebtCoreDoctrineDbal\GameRepository;
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
    addEntry($_GET["fname1"], $_GET["lname1"], $_GET["fname2"], $_GET["lname2"], $_GET["move1"], $_GET["move2"]);
}

/**
 * @throws \Doctrine\DBAL\Exception
 */
function addEntry(string $fname1, string $lname1, string $fname2, string $lname2, string $move1, string $move2): void
{
    $player1 = PlayerRepository::add(new Player(null, $fname1, $lname1));
    $player2 = PlayerRepository::add(new Player(null, $fname2, $lname2));

    $game = GameRepository::add(new Game(null, $player1, $player2, $move1, $move2, date('Y-m-d H:i:s'), determineWinner($move1, $move2)));
}


function removeEntry()
{

}

$template = $twig->load('template.html');

echo $template->render(['games' => GameRepository::getAll()]);



