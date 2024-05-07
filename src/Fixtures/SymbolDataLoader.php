<?php

namespace DucklingDesigns\WebtCoreDoctrineDbal\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use DucklingDesigns\WebtCoreDoctrineDbal\Model\Symbol;

class SymbolDataLoader extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $rock = new Symbol();
        $rock->setName('Rock');

        $paper = new Symbol();
        $paper->setName('Paper');

        $scissors = new Symbol();
        $scissors->setName('Scissors');

        $manager->persist($rock);
        $manager->persist($paper);
        $manager->persist($scissors);
        $manager->flush();

        $this->addReference('rock', $rock);
        $this->addReference('paper', $paper);
        $this->addReference('scissors', $scissors);
    }
}