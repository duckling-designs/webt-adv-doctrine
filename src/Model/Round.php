<?php

namespace DucklingDesigns\WebtCoreDoctrineDBAL\Model;

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
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private string $date_played;

    #[ORM\Column(name: 'fk_player_1', type: 'integer')]
    #[ORM\OneToOne(targetEntity: 'Player')]
    private int $player_1;

    #[ORM\Column(name: 'fk_player_2', type: 'integer')]
    #[ORM\OneToOne(targetEntity: 'Player')]
    private int $player_2;

    #[ORM\Column(name: 'fk_player_1_symbol', type: 'integer')]
    #[ORM\OneToOne(targetEntity: 'Symbol')]
    private int $player_1_symbol;

    #[ORM\Column(name: 'fk_player_2_symbol', type: 'integer')]
    #[ORM\OneToOne(targetEntity: 'Symbol')]
    private int $player_2_symbol;

    public function __construct(int $player_1, int $player_2, int $player_1_symbol, int $player_2_symbol)
    {
        $this->player_1 = $player_1;
        $this->player_2 = $player_2;
        $this->player_1_symbol = $player_1_symbol;
        $this->player_2_symbol = $player_2_symbol;
    }

    public function getPkId(): int
    {
        return $this->pk_id;
    }

    public function setPkId(int $pk_id): void
    {
        $this->pk_id = $pk_id;
    }

    public function getDatePlayed(): string
    {
        return $this->date_played;
    }

    public function setDatePlayed(string $date_played): void
    {
        $this->date_played = $date_played;
    }

    public function getPlayer1(): int
    {
        return $this->player_1;
    }

    public function setPlayer1(int $player_1): void
    {
        $this->player_1 = $player_1;
    }

    public function getPlayer2(): int
    {
        return $this->player_2;
    }

    public function setPlayer2(int $player_2): void
    {
        $this->player_2 = $player_2;
    }

    public function getPlayer1Symbol(): int
    {
        return $this->player_1_symbol;
    }

    public function setPlayer1Symbol(int $player_1_symbol): void
    {
        $this->player_1_symbol = $player_1_symbol;
    }

    public function getPlayer2Symbol(): int
    {
        return $this->player_2_symbol;
    }

    public function setPlayer2Symbol(int $player_2_symbol): void
    {
        $this->player_2_symbol = $player_2_symbol;
    }
}