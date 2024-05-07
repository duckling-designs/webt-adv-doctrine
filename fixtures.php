<?php
require_once 'vendor/autoload.php';
require __DIR__ . '/bootstrap.php';

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;
use DucklingDesigns\WebtCoreDoctrineDbal\Fixtures\PlayerDataLoader;
use DucklingDesigns\WebtCoreDoctrineDbal\Fixtures\RoundDataLoader;
use DucklingDesigns\WebtCoreDoctrineDbal\Fixtures\SymbolDataLoader;

$loader = new Loader();
$loader->addFixture(new PlayerDataLoader());
$loader->addFixture(new SymbolDataLoader());
$loader->addFixture(new RoundDataLoader());

$executor = new ORMExecutor($entityManager, new ORMPurger());
$executor->execute($loader->getFixtures());