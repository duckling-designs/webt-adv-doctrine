<?php

namespace DucklingDesigns\WebtCoreDoctrineDbal\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use DucklingDesigns\WebtCoreDoctrineDbal\Model\Player;
use DucklingDesigns\WebtCoreDoctrineDBAL\Model\Round;
use DucklingDesigns\WebtCoreDoctrineDbal\Model\Symbol;

class RoundDataLoader extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $round1 = new Round();
        $round1->setPlayer1($this->getReference('player1', Player::class));
        $round1->setPlayer2($this->getReference('player2', Player::class));
        $round1->setPlayer1Symbol($this->getReference('rock', Symbol::class));
        $round1->setPlayer2Symbol($this->getReference('scissors', Symbol::class));

        $round2 = new Round();
        $round2->setPlayer1($this->getReference('player3', Player::class));
        $round2->setPlayer2($this->getReference('player4', Player::class));
        $round2->setPlayer1Symbol($this->getReference('paper', Symbol::class));
        $round2->setPlayer2Symbol($this->getReference('rock', Symbol::class));

        $round3 = new Round();
        $round3->setPlayer1($this->getReference('player1', Player::class));
        $round3->setPlayer2($this->getReference('player3', Player::class));
        $round3->setPlayer1Symbol($this->getReference('paper', Symbol::class));
        $round3->setPlayer2Symbol($this->getReference('paper', Symbol::class));

        $round4 = new Round();
        $round4->setPlayer1($this->getReference('player2', Player::class));
        $round4->setPlayer2($this->getReference('player4', Player::class));
        $round4->setPlayer1Symbol($this->getReference('rock', Symbol::class));
        $round4->setPlayer2Symbol($this->getReference('paper', Symbol::class));

        $manager->persist($round1);
        $manager->persist($round2);
        $manager->persist($round3);
        $manager->persist($round4);
        $manager->flush();
    }
}