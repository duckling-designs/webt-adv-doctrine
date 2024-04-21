<?php
require_once 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

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
    ->select('*')
    ->from('games', 'g')
    ->innerJoin('g', 'symbol', 's', 'g.pk_id = s.fk_game_id')
    ->innerJoin('g', 'player', 'p', 's.fk_player_id = p.pk_id')
    ->orderBy('g.pk_id', 'ASC');

echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RPS Tournament</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Bahnschrift, Arial, sans-serif;
            color: white;
        }

        .centeredContent {
            text-align: center;
            background: #6d98c3;
            width: 80vw;
            height: 90vh;
            border-radius: 15px;
        }

        h1 {
            font-style: italic;
            margin: 20px;
        }

        .gameRound {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            margin: 20px;
            border-bottom-style: solid;
            flex-wrap: wrap;
        }
        p {
            margin-left: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="centeredContent">
        <h1>USARPS Tournament</h1>
        <h2>16.04.2024</h2>
HTML;
$results = [];
try {
    $result = $queryBuilder->executeQuery()->fetchAllAssociative();
} catch (\Doctrine\DBAL\Exception $e) {
    echo $e->getMessage();
}
var_dump($result);
foreach ($results as $round) {
    echo <<<HTML
    <div class="gameRound">
        <h3>Round {$round['pk_id']}</h3>
        <p>{$round['username']}: {$round['symbol_name']}</p>
        <p>Winner: {$round['username']}</p>
        <p>Date: {$round['date_played']}</p>
    </div>
HTML;
}
echo "after foreach";

echo <<<HTML
</div>
</div>
</body>
</html>
HTML;