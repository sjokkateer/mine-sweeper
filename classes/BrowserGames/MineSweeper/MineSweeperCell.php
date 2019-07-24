<?php
namespace BrowserGames\MineSweeper;

class MineSweeperCell
{
    private $mine;
    private $minesCount;
    private $neighbors;

    public function __construct()
    {
        $this->mine = false;
        $this->minesCount = 0;
        $this->neighbors = [];
    }

    public function isMine(): bool
    {
        return $this->mine;
    }

    /**
     * Get the value of minesCount
     */ 
    public function getMinesCount(): int
    {
        return $this->minesCount;
    }

    /**
     * Set the value of mine
     */ 
    public function setMine(bool $mine)
    {
        $this->mine = $mine;
    }

    /**
     * Set the value of minesCount
     */ 
    public function setMinesCount(int $minesCount)
    {
        $this->minesCount = $minesCount;
    }

    public function addNeighbor(MineSweeperCell $cell)
    {
        $this->neighbors[] = $cell;
    }

    public function __toString(): string
    {
        $result = "Mine: {$this->mine}";
        return $result;
    }
}