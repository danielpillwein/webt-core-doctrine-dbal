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

if (isset($_GET["fname1"])) {
    addEntry($_GET["fname1"], $_GET["lname1"], $_GET["fname2"], $_GET["lname2"], $_GET["move1"], $_GET["move2"]);
}

if (isset($_GET["remove"])) {
    removeEntry($_GET["remove"]);
}

/**
 * @throws \Doctrine\DBAL\Exception
 */
function addEntry(string $fname1, string $lname1, string $fname2, string $lname2, string $move1, string $move2): void
{
    // $player1 = Player Objekt mit Primary Key
    $player1 = PlayerRepository::add(new Player(null, $fname1, $lname1));
    $player2 = PlayerRepository::add(new Player(null, $fname2, $lname2));

    GameRepository::add(new Game(null, $player1, $player2, $move1, $move2, date('Y-m-d H:i:s')));
}


function removeEntry($game_id)
{
    GameRepository::remove($game_id);
}

$template = $twig->load('template.html');

echo $template->render(['games' => GameRepository::getAll()]);



