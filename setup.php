<?php
// bootstrap.php
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\Common\DataFixtures\Loader;
use Lukas\WebtCoreDoctrineDbal\GameDataLoader;
use Lukas\WebtCoreDoctrineDbal\PlayerDataLoader;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/src"),
    isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqite',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);

$loader = new Loader();
$loader->addFixture(new PlayerDataLoader());
$loader->addFixture(new GameDataLoader());

$executor = new ORMExecutor($entityManager, new ORMPurger());
$executor->execute($loader->getFixtures());
