<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;


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

$sql = "SELECT P1.FNAME AS NAMEONE, P2.FNAME AS NAMETWO, MOVEONE, MOVETWO, DATE
FROM GAME
         JOIN PLAYER P1 ON GAME.FK_PLAYERONE = P1.PK_PLAYER_ID
         JOIN PLAYER P2 ON GAME.FK_PLAYERTWO = P2.PK_PLAYER_ID;
";
$stmt = $conn->query($sql); // Simple, but has several drawbacks

$games = [];

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

while (($row = $stmt->fetchAssociative()) !== false) {
    $winner = determineWinner($row['MOVEONE'], $row['MOVETWO']);
    $games[] = new \Lukas\WebtCoreDoctrineDbal\Game($row['NAMEONE'], $row['NAMETWO'], $row['MOVEONE'], $row['MOVETWO'], $row['DATE'], $winner);
}

$template = $twig->load('template.html');

echo $template->render(['games' => $games]);



