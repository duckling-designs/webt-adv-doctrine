<?php

namespace DucklingDesigns\WebtCoreDoctrineDbal\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use DucklingDesigns\WebtCoreDoctrineDbal\Model\Player;
use Doctrine\Persistence\ObjectManager;

class PlayerDataLoader  extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $player1 = new Player();
        $player1->setName('Raven');

        $player2 = new Player();
        $player2->setName('Eagle');

        $player3 = new Player();
        $player3->setName('Hawk');

        $player4 = new Player();
        $player4->setName('Falcon');

        $manager->persist($player1);
        $manager->persist($player2);
        $manager->persist($player3);
        $manager->persist($player4);
        $manager->flush();

        $this->addReference('player1', $player1);
        $this->addReference('player2', $player2);
        $this->addReference('player3', $player3);
        $this->addReference('player4', $player4);
    }
}