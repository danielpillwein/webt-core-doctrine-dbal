<?php

namespace Lukas\WebtCoreDoctrineDbal;

use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DataLoader implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $daniel = new Player();
        $daniel->setFname("Daniel");
        $daniel->setLname("Pillwein");

        $lukas = new Player();
        $lukas->setFname("Lukas");
        $lukas->setLname("Schodl");

        $gabriel = new Player();
        $gabriel->setFname("Gabriel");
        $gabriel->setLname("Forstner");

        $matthias = new Player();
        $matthias->setFname("Matthias");
        $matthias->setLname("Wagner");

        $manager->persist($daniel);
        $manager->persist($lukas);
        $manager->persist($gabriel);
        $manager->persist($matthias);

        $game1 = new Game();
        $game1->setMoveOne("Rock");
        $game1->setMoveTwo("Paper");
        $game1->setDate(new DateTime("2023-04-19 10:00:00"));
        $game1->setPlayerOne($lukas);
        $game1->setPlayerTwo($daniel);

        $game2 = new Game();
        $game2->setMoveOne("Paper");
        $game2->setMoveTwo("Scissors");
        $game2->setDate(new DateTime("2023-04-19 10:15:00"));
        $game2->setPlayerOne($matthias);
        $game2->setPlayerTwo($gabriel);

        $game3 = new Game();
        $game3->setMoveOne("Scissors");
        $game3->setMoveTwo("Rock");
        $game3->setDate(new DateTime("2023-04-19 10:30:00"));
        $game3->setPlayerOne($daniel);
        $game3->setPlayerTwo($matthias);

        $game4 = new Game();
        $game4->setMoveOne("Paper");
        $game4->setMoveTwo("Rock");
        $game4->setDate(new DateTime("2023-04-19 10:45:00"));
        $game4->setPlayerOne($gabriel);
        $game4->setPlayerTwo($daniel);

        $game5 = new Game();
        $game5->setMoveOne("Scissors");
        $game5->setMoveTwo("Paper");
        $game5->setDate(new DateTime("2023-04-19 11:00:00"));
        $game5->setPlayerOne($lukas);
        $game5->setPlayerTwo($matthias);

        $manager->persist($game1);
        $manager->persist($game2);
        $manager->persist($game3);
        $manager->persist($game4);
        $manager->persist($game5);

        $manager->flush();
    }
}