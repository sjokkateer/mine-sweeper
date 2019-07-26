<?php
namespace BrowserGames\GridGames\Difficulty;

class GridGameDifficulty
{
    private $name;
    private $numberOfDefaultValues;
    private $rows;
    private $columns;

    public function __construct(string $name, int $numberOfDefaultValues, int $rows, int $columns)
    {
        $this->name = $name;
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

    public function __toString(): string
    {
        return $this->name;
    }
}