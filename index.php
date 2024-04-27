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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player1 = $_POST['player1'];
    $symbol1 = $_POST['symbol1'];
    $player2 = $_POST['player2'];
    $symbol2 = $_POST['symbol2'];

    if ($player1 !== $player2) {
        try {
            $player1ID = $conn->createQueryBuilder()->select('pk_id')
                ->from('player')
                ->where('username = \'' . $player1 . '\'')
                ->executeQuery()
                ->fetchOne();

            if (!$player1ID) {
                $conn->createQueryBuilder()->insert('player')
                    ->values(['username' => '?'])
                    ->setParameter(0, $player1)
                    ->executeStatement();
                $player1ID = $conn->lastInsertId();
            }

            $player2ID = $conn->createQueryBuilder()->select('pk_id')
                ->from('player')
                ->where('username = \'' . $player2 . '\'')
                ->executeQuery()
                ->fetchOne();

            if (!$player2ID) {
                $conn->createQueryBuilder()->insert('player')
                    ->values(['username' => '?'])
                    ->setParameter(0, $player2)
                    ->executeStatement();
                $player2ID = $conn->lastInsertId();
            }
            $symbol1ID = $conn->createQueryBuilder()->select('symbols.pk_id')
                ->from('symbols')
                ->where('symbols.symbol = ?')
                ->setParameter(0, $symbol1)
                ->executeQuery()
                ->fetchOne();

            $symbol2ID = $conn->createQueryBuilder()->select('symbols.pk_id')
                ->from('symbols')
                ->where('symbols.symbol = ?')
                ->setParameter(0, $symbol2)
                ->executeQuery()
                ->fetchOne();

            $conn->createQueryBuilder()->insert('rounds')
                ->values([
                    'fk_player_1' => '?',
                    'fk_player_2' => '?',
                    'fk_player_1_symbol' => '?',
                    'fk_player_2_symbol' => '?',
                    'date_played' => '?'
                ])
                ->setParameter(0, $player1ID)
                ->setParameter(1, $player2ID)
                ->setParameter(2, $symbol1ID)
                ->setParameter(3, $symbol2ID)
                ->setParameter(4, date('Y-m-d H:i:s'))
                ->executeStatement();
        } catch (Exception $e) {
            echo 'line 86' . $e->getMessage();
        }
    }

}
$print = $conn->createQueryBuilder();

$print
    ->select('r.pk_id', 'p.username as Player1', 's.symbol as Symbol1', 'p2.username as Player2', 's2.symbol as Symbol2', 'r.date_played')
    ->from('rounds', 'r')
    ->innerJoin('r', 'player', 'p', 'p.pk_id = r.fk_player_1')
    ->innerJoin('r', 'symbols', 's', 'r.fk_player_1_symbol = s.pk_id')
    ->innerJoin('r', 'player', 'p2', 'p2.pk_id = r.fk_player_2')
    ->innerJoin('r', 'symbols', 's2', 'r.fk_player_2_symbol = s2.pk_id')
    ->orderBy('r.pk_id', 'ASC');

$loader = new FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);
$vars = [];

try {
    $vars = ['rounds' => $print->executeQuery()->fetchAllAssociative()];
} catch (Exception $e) {
    echo 'line 109' . $e->getMessage();
}

try {
    echo $twig->render('index.html', $vars);
} catch (Exception|SyntaxError|LoaderError|RuntimeError $e) {
    echo 'line 115' . $e->getMessage();
}
