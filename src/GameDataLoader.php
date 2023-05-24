<?php

namespace Lukas\WebtCoreDoctrineDbal;

use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GameDataLoader implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $game1 = new Game();
        $game1->setPlayerOneId(1);
        $game1->setPlayerTwoId(2);
        $game1->setMoveOne("Rock");
        $game1->setMoveTwo("Paper");
        $game1->setDate(new DateTime("2023-04-19 10:00:00"));

        $game2 = new Game();
        $game2->setPlayerOneId(2);
        $game2->setPlayerTwoId(3);
        $game2->setMoveOne("Paper");
        $game2->setMoveTwo("Scissors");
        $game2->setDate(new DateTime("2023-04-19 10:15:00"));

        $game3 = new Game();
        $game3->setPlayerOneId(3);
        $game3->setPlayerTwoId(4);
        $game3->setMoveOne("Scissors");
        $game3->setMoveTwo("Rock");
        $game3->setDate(new DateTime("2023-04-19 10:30:00"));

        $game4 = new Game();
        $game4->setPlayerOneId(4);
        $game4->setPlayerTwoId(1);
        $game4->setMoveOne("Paper");
        $game4->setMoveTwo("Rock");
        $game4->setDate(new DateTime("2023-04-19 10:45:00"));

        $game5 = new Game();
        $game5->setPlayerOneId(1);
        $game5->setPlayerTwoId(3);
        $game5->setMoveOne("Scissors");
        $game5->setMoveTwo("Paper");
        $game5->setDate(new DateTime("2023-04-19 11:00:00"));

        $manager->persist($game1);
        $manager->persist($game2);
        $manager->persist($game3);
        $manager->persist($game4);
        $manager->persist($game5);
        $manager->flush();
    }
}