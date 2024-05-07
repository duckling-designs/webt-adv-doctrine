<?php

namespace DucklingDesigns\WebtCoreDoctrineDbal\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'players')]
class Player
{
    #[ORM\Id]
    #[ORM\Column(name: 'pk_id', type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $pk_id;

    #[ORM\Column(name: 'name', type: 'string')]
    private string $name;

    public function __construct(int $pk_id, string $name)
    {
        $this->pk_id = $pk_id;
        $this->name = $name;
    }

    public function getPkId(): int
    {
        return $this->pk_id;
    }

    public function setPkId(int $pk_id): void
    {
        $this->pk_id = $pk_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}