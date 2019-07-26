<?php
namespace BrowserGames\GridGames\Difficulty;

abstract class GridGameDifficulty
{
    private $numberOfDefaultValues;
    private $rows;
    private $columns;

    public function __construct(int $numberOfDefaultValues, int $rows, int $columns)
    {
        $this->numberOfDefaultValues = $numberOfDefaultValues;
        $this->rows = $rows;
        $this->columns = $columns;
    }

    /**
     * Get the value of numberOfDefaultValues
     */ 
    public function getNumberOfDefaultValues(): int
    {
        return $this->numberOfDefaultValues;
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