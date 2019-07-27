<?php
namespace BrowserGames\GridGames;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

use Generics\Cell;
use Generics\AbstractGame;
use Generics\Difficulty;

abstract class AbstractGridGame extends AbstractGame
{
    protected $grid;
    private $rows;
    private $columns;

    public function __construct(string $name, GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        parent::__construct($name, $difficulty);
        $this->rows = $rows;
        $this->columns = $columns;
        $this->grid = $this->initializeGrid();
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    /**
     * Get the cell at $row index, $column index in the grid
     */ 
    public function getCell(int $row, int $column): Cell
    {
        return $this->grid[$row][$column];
    }

    public function getValue(int $row, int $column)
    {
        return $this->getCell($row, $column)->getValue();
    }

    abstract protected function initializeGrid(): array;
}