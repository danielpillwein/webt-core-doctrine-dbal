<?php

use Doctrine\ORM\EntityManager;
use Lukas\WebtCoreDoctrineDbal\Game;
use Lukas\WebtCoreDoctrineDbal\Player;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';
require_once 'bootstrap.php';

$loader = new FilesystemLoader('./templates');
$twig = new Environment($loader);

if (isset($_GET["fname1"])) {
    addEntry($_GET["fname1"], $_GET["lname1"], $_GET["fname2"], $_GET["lname2"], $_GET["move1"], $_GET["move2"], $entityManager);
}

if (isset($_GET["remove"])) {
    removeEntry($_GET["remove"], $entityManager);
}

function addEntry(string $fname1, string $lname1, string $fname2, string $lname2, string $move1, string $move2, EntityManager $entityManager): void
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
    $game->setMoveOne($move1);
    $game->setMoveTwo($move2);
    $game->setDate(new DateTime("now"));
    $game->setPlayerOne($player1);
    $game->setPlayerTwo($player2);

    $entityManager->persist($game);

    $entityManager->flush();
}

function removeEntry($game_id, EntityManager $entityManager): void
{
    $gameRepository = $entityManager->getRepository('Lukas\WebtCoreDoctrineDbal\Game');
    $single_game = $gameRepository->find($game_id);
    $entityManager->remove($single_game);
    $entityManager->flush();
}

$template = $twig->load('template.html');

$gameRepository = $entityManager->getRepository('Lukas\WebtCoreDoctrineDbal\Game');
$games = $gameRepository->findAll();

echo $template->render(['games' => $games]);