<?php
namespace DucklingDesigns\WebtCoreDoctrineDBAL;
require_once 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

$connectionParams = [
    'dbname' => 'rps_db',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);

$queryBuilder = $conn->createQueryBuilder();

$queryBuilder
    ->select('r.pk_id', 'p.username as Player1', 's.symbol as Symbol1', 'p2.username as Player2', 's2.symbol as Symbol2', 'r.date_played')
    ->from('rounds', 'r')
    ->innerJoin('r', 'player', 'p', 'p.pk_id = r.fk_player_1')
    ->innerJoin('r', 'symbols', 's', 'r.fk_player_1_symbol = s.pk_id')
    ->innerJoin('r', 'player', 'p2', 'p2.pk_id = r.fk_player_2')
    ->innerJoin('r', 'symbols', 's2', 'r.fk_player_2_symbol = s2.pk_id')
    ->orderBy('r.pk_id', 'ASC');

$loader = new FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);

$vars = ['rounds' => $queryBuilder->executeQuery()->fetchAllAssociative()];

try {
    echo $twig->render('index.html', $vars);
} catch (Exception|SyntaxError|LoaderError|RuntimeError $e) {
    echo $e->getMessage();
}
