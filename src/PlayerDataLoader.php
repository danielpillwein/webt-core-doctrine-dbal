<?php

namespace Lukas\WebtCoreDoctrineDbal;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayerDataLoader implements FixtureInterface
{
    public function load(ObjectManager $manager): void
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
        $manager->flush();
    }
}