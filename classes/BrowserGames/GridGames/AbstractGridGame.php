<?php
namespace BrowserGames\GridGames;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

use Generics\Cell;
use Generics\AbstractGame;

abstract class AbstractGridGame extends AbstractGame
{
    private $difficulty;
    protected $grid;
    private $rows;
    private $columns;

    public function __construct(GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        $this->difficulty = $difficulty;
        $this->rows = $rows;
        $this->columns = $columns;
        $this->grid = $this->initializeGrid();
    }

    public function getDifficulty(): GridGameDifficulty
    {
        return $this->difficulty;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    public function getNumberOfDefaultValues(): int
    {
        return $this->difficulty->getNumberOfDefaultValues();
    }

    /**
     * Get the cell at $row index, $column index in the mines array
     */ 
    public function getCell(int $row, int $column): Cell
    {
        return $this->grid[$row][$column];
    }

    abstract protected function initializeGrid(): array;
}