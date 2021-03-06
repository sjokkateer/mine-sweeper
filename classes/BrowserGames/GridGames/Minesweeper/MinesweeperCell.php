<?php

namespace BrowserGames\GridGames\Minesweeper;

use Generics\Cell;

class MinesweeperCell extends Cell
{
    private bool $clicked;
    private bool $flagged;
    private int $minesCount;
    private array $neighbors;

    public function __construct(int $row, int $column)
    {
        parent::__construct($row, $column, false);

        $this->clicked = false;
        $this->flagged = false;
        $this->minesCount = 0;
        $this->neighbors = [];
    }

    /**
     * Get the value of minesCount
     */
    public function getMinesCount(): int
    {
        return $this->minesCount;
    }

    /**
     * Set the value of minesCount
     */
    public function incrementMinesCount()
    {
        $this->minesCount++;
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

    public function isMine()
    {
        return $this->getValue();
    }

    /**
     * Set the value of value to true
     */
    public function setMine()
    {
        $this->setValue(true);
        $this->minesCount = 1;
    }

    public function addNeighbor(MinesweeperCell $cell)
    {
        if ($cell !== null) {
            $this->neighbors[] = $cell;
        }
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
    public function isFlagged(): bool
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

    public function __toString(): string
    {
        $result = ' ';
        if ($this->isClicked()) {
            if ($this->isMine()) {
                $result = '*';
            } elseif ($this->getMinesCount() > 0) {
                $result = $this->getMinesCount();
            }
        }

        return $result;
    }
}
