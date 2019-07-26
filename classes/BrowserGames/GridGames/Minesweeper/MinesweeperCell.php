<?php
namespace BrowserGames\GridGames\Minesweeper;

use Generics\Index;

class MinesweeperCell
{
    private $index;
    private $clicked;
    private $flagged;
    private $mine;
    private $minesCount;
    private $neighbors;

    public function __construct(int $row, int $column)
    {
        $this->index = new Index($row, $column);
        $this->clicked = false;
        $this->flagged = false;
        $this->mine = false;
        $this->gridCount = 0;
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
        return $this->gridCount;
    }

    /**
     * Set the value of mine
     */ 
    public function setMine()
    {
        $this->mine = true;
        $this->gridCount = 1;
    }

    /**
     * Set the value of minesCount
     */ 
    public function setMinesCount(int $minesCount)
    {
        $this->gridCount = $minesCount;
    }

    public function addNeighbor(MinesweeperCell $cell)
    {
        $this->neighbors[] = $cell;
    }

    public function __toString(): string
    {
        $result = ' ';
        if ($this->isClicked()) {
            if ($this->isMine()) {
                $result = '*';
            } else if ($this->getMinesCount() > 0) {
                $result = $this->getMinesCount();
            }
        }
        return $result;
    }

    /**
     * Get the value of index
     */ 
    public function getIndex(): Index
    {
        return $this->index;
    }

    /**
     * Get the value of clicked
     */ 
    public function isClicked(): bool
    {
        return $this->clicked;
    }

    /**
     * Set the value of clicked
     */ 
    public function setClicked()
    {
        $this->clicked = true;
    }

    /**
     * Get the value of neighbors
     */ 
    public function getNeighbors()
    {
        return $this->neighbors;
    }

    /**
     * Get the value of flagged
     */ 
    public function isFlagged()
    {
        return $this->flagged;
    }

    /**
     * Set the value of flagged
     */ 
    public function setFlagged(bool $flagged)
    {
        $this->flagged = $flagged;
    }
}