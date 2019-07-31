<?php
namespace BrowserGames\GridGames\Minesweeper;

use Generics\Cell;

class MinesweeperCell extends Cell
{
    private $clicked;
    private $flagged;
    private $minesCount;
    private $neighbors;

    public function __construct(int $row, int $column)
    {
        parent::__construct($row, $column, false); // False can be removed too later on
        $this->clicked = false;
        $this->flagged = false;
        $this->minesCount = 0;
        $this->neighbors = [];
    }

    public function isMine()
    {
        return $this->getValue();
    }

    /**
     * Get the value of minesCount
     */ 
    public function getMinesCount(): int
    {
        return $this->minesCount;
    }

    /**
     * Set the value of value to true
     */ 
    public function setMine()
    {
        $this->setValue(true);
        $this->minesCount = 1;
    }

    /**
     * Set the value of minesCount
     */ 
    public function setMinesCount(int $minesCount)
    {
        if ($minesCount >= 0) {
            $this->minesCount = $minesCount;
        } else {
            throw new InvalidMinesCountException("MinesCount has to be >= 0, got $minesCount");
        }
    }

    public function addNeighbor(MinesweeperCell $cell)
    {
        $this->neighbors[] = $cell;
    }

    public function __toString(): string
    {
        $result = ' ';
        if ($this->isClicked()) {
            if ($this->getMinesCount() > 0) {
                $result = $this->getMinesCount();
            }
        }
        return $result;
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