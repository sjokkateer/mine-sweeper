<?php
namespace BrowserGames\MineSweeper;

use Generics\Index;

class MineSweeperCell
{
    private $index;
    private $clicked;
    private $mine;
    private $minesCount;
    private $neighbors;

    public function __construct(int $row, int $column)
    {
        $this->index = new Index($row, $column);
        $this->clicked = false;
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
    public function setMine()
    {
        $this->mine = true;
        $this->minesCount = 1;
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
        $isMine = $this->mine ? 'IS A' : 'IS NOT A';
        $result = "$isMine MINE";
        $result .= "<br />";
        $result .= "Index: {$this->index}";
        $result .= '<br />';
        $result .= '<br />';
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
}