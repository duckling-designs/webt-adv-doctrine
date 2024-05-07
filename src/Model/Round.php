<?php

namespace DucklingDesigns\WebtCoreDoctrineDbal\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'rounds')]
class Round
{
    #[ORM\Id]
    #[ORM\Column(name: 'pk_id', type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $pk_id;

    #[ORM\Column(name: 'date_played', type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $date_played;

    #[ORM\ManyToOne(targetEntity: 'Player')]
    #[ORM\JoinColumn(name: 'fk_player_1', referencedColumnName: 'pk_id')]
    private Player $player_1;

    #[ORM\ManyToOne(targetEntity: 'Player')]
    #[ORM\JoinColumn(name: 'fk_player_2', referencedColumnName: 'pk_id')]
    private Player $player_2;

    #[ORM\ManyToOne(targetEntity: 'Symbol')]
    #[ORM\JoinColumn(name: 'fk_player_1_symbol', referencedColumnName: 'pk_id')]
    private Symbol $player_1_symbol;

    #[ORM\ManyToOne(targetEntity: 'Symbol')]
    #[ORM\JoinColumn(name: 'fk_player_2_symbol', referencedColumnName: 'pk_id')]
    private Symbol $player_2_symbol;

    public function __construct()
    {
        $this->date_played = new \DateTime();
    }

    public function getPkId(): int
    {
        return $this->pk_id;
    }

    public function setPkId(int $pk_id): void
    {
        $this->pk_id = $pk_id;
    }

    public function getDatePlayed(): \DateTime
    {
        return $this->date_played;
    }

    public function setDatePlayed(\DateTime $date_played): void
    {
        $this->date_played = $date_played;
    }

    public function getPlayer1(): Player
    {
        return $this->player_1;
    }

    public function setPlayer1(Player $player_1): void
    {
        $this->player_1 = $player_1;
    }

    public function getPlayer2(): Player
    {
        return $this->player_2;
    }

    public function setPlayer2(Player $player_2): void
    {
        $this->player_2 = $player_2;
    }

    public function getPlayer1Symbol(): Symbol
    {
        return $this->player_1_symbol;
    }

    public function setPlayer1Symbol(Symbol $player_1_symbol): void
    {
        $this->player_1_symbol = $player_1_symbol;
    }

    public function getPlayer2Symbol(): Symbol
    {
        return $this->player_2_symbol;
    }

    public function setPlayer2Symbol(Symbol $player_2_symbol): void
    {
        $this->player_2_symbol = $player_2_symbol;
    }
}