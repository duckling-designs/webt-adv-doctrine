<?php

namespace DucklingDesigns\WebtCoreDoctrineDBAL;
global $entityManager;
require_once 'vendor/autoload.php';
require __DIR__ . '/bootstrap.php';

use Doctrine\ORM\Exception\ORMException;
use DucklingDesigns\WebtCoreDoctrineDbal\Model\Player;
use DucklingDesigns\WebtCoreDoctrineDbal\Model\Round;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\Intl\IntlExtension;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['deleteRound'])) {
    $roundID = $_POST['deleteRound'];
    $entityManager->createQueryBuilder()->delete('DucklingDesigns\WebtCoreDoctrineDbal\Model\Round', 'r')
        ->where('r.pk_id = ?0')
        ->setParameter(0, $roundID)
        ->getQuery()
        ->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['player1']) && isset($_POST['symbol1']) && isset($_POST['player2']) && isset($_POST['symbol2'])) {
    $player1name = $_POST['player1'];
    $symbol1name = $_POST['symbol1'];
    $player2name = $_POST['player2'];
    $symbol2name = $_POST['symbol2'];

    if ($player1name !== $player2name) {
        try {
            $player1 = $entityManager->createQueryBuilder()->select('p')
                ->from('DucklingDesigns\WebtCoreDoctrineDbal\Model\Player', 'p')
                ->where('p.name = ?0')
                ->setParameter(0, $player1name)
                ->getQuery()
                ->getOneOrNullResult();

            if (!$player1) {
                $player1 = new Player();
                $player1->setName($player1name);
                $entityManager->persist($player1);
                $entityManager->flush();
            }

            $player2 = $entityManager->createQueryBuilder()->select('p')
                ->from('DucklingDesigns\WebtCoreDoctrineDbal\Model\Player', 'p')
                ->where('p.name = ?0')
                ->setParameter(0, $player2name)
                ->getQuery()
                ->getOneOrNullResult();

            if (!$player2) {
                $player2 = new Player();
                $player2->setName($player2name);
                $entityManager->persist($player2);
                $entityManager->flush();
            }

            $symbol1 = $entityManager->createQueryBuilder()->select('s')
                ->from('DucklingDesigns\WebtCoreDoctrineDbal\Model\Symbol', 's')
                ->where('s.name = ?0')
                ->setParameter(0, $symbol1name)
                ->getQuery()
                ->getOneOrNullResult();

            $symbol2 = $entityManager->createQueryBuilder()->select('s')
                ->from('DucklingDesigns\WebtCoreDoctrineDbal\Model\Symbol', 's')
                ->where('s.name = ?0')
                ->setParameter(0, $symbol2name)
                ->getQuery()
                ->getOneOrNullResult();

            $round = new Round();
            $round->setPlayer1($player1);
            $round->setPlayer2($player2);
            $round->setPlayer1Symbol($symbol1);
            $round->setPlayer2Symbol($symbol2);
            $entityManager->persist($round);
            $entityManager->flush();
        } catch (ORMException $e) {
            echo $e->getMessage();
        }
    }
}

$print = $entityManager->createQueryBuilder();
$print
    ->select('r.pk_id', 'p.name as Player1', 's.name as Symbol1', 'p2.name as Player2', 's2.name as Symbol2', 'r.date_played')
    ->from('DucklingDesigns\WebtCoreDoctrineDbal\Model\Round', 'r')
    ->join('r.player_1', 'p')
    ->join('r.player_1_symbol', 's')
    ->join('r.player_2', 'p2')
    ->join('r.player_2_symbol', 's2')
    ->orderBy('r.pk_id', 'ASC');

$loader = new FilesystemLoader('./templates');
$twig = new Environment($loader);
$twig->addExtension(new IntlExtension());

$vars = ['rounds' => $print->getQuery()->getResult()];

try {
    echo $twig->render('index.html', $vars);
} catch (SyntaxError|LoaderError|RuntimeError $e) {
    echo $e->getMessage();
}
