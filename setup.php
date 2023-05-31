<?php
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;
use Lukas\WebtCoreDoctrineDbal\DataLoader;
use Lukas\WebtCoreDoctrineDbal\GameDataLoader;
use Lukas\WebtCoreDoctrineDbal\PlayerDataLoader;

require_once "vendor/autoload.php";
require_once "bootstrap.php";

$loader = new Loader();
$loader->addFixture(new DataLoader());

$executor = new ORMExecutor($entityManager, new ORMPurger());
$executor->execute($loader->getFixtures());
