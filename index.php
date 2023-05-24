<?php

use Lukas\WebtCoreDoctrineDbal\Game;
use Lukas\WebtCoreDoctrineDbal\Player;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';
require_once 'bootstrap.php';

$loader = new FilesystemLoader('./templates');
$twig = new Environment($loader);

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
    $player1 = new Player();
    $player1->setFname($fname1);
    $player1->setLname($lname1);

    $player2 = new Player();
    $player2->setFname($fname2);
    $player2->setLname($lname2);

    $entityManager->persist($player1);
    $entityManager->persist($player2);

    $game = new Game();
    $game->setPlayerOneId($player1->getPlayerId());
    $game->setPlayerTwoId($player2->getPlayerId());
    $game->setMoveOne($move1);
    $game->setMoveTwo($move2);
    $game->setDate(new DateTime("now"));

    $entityManager->persist($game);
}


function removeEntry($game_id): void
{
    GameRepository::remove($game_id);
}

$template = $twig->load('template.html');

$gameRepository = $entityManager->getRepository('Lukas\WebtCoreDoctrineDbal\Game');
$games = $gameRepository->findAll();

echo $games[0]->getMoveOne();

echo $template->render(['games' => $games]);