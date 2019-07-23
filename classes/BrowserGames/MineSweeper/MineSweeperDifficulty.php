<?php
namespace BrowserGames\MineSweeper;

abstract class MineSweeperDifficulty
{
    private $numberOfMines;
    private $rows;
    private $columns;

    public function __construct(int $numberOfMines, int $rows, int $columns)
    {
        $this->numberOfMines = $numberOfMines;
        $this->rows = $rows;
        $this->columns = $columns;
    }

    /**
     * Get the value of numberOfMines
     */ 
    public function getNumberOfMines(): int
    {
        return $this->numberOfMines;
    }

    /**
     * Get the value of rows
     */ 
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * Get the value of columns
     */ 
    public function getColumns(): int
    {
        return $this->columns;
    }
}