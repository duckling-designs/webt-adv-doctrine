<?php

namespace DucklingDesigns\WebtCoreDoctrineDBAL\Model;

class Round
{
    public function __construct(protected int $round_id, protected string $player1, protected string $symbol1, protected string $player2, protected string $symbol2, protected string $result)
    {
    }

    public function getRoundId(): int
    {
        return $this->round_id;
    }

    public function getPlayer1(): string
    {
        return $this->player1;
    }

    public function getSymbol1(): string
    {
        return $this->symbol1;
    }

    public function getPlayer2(): string
    {
        return $this->player2;
    }

    public function getSymbol2(): string
    {
        return $this->symbol2;
    }

    public function getResult(): string
    {
        return $this->result;
    }
}