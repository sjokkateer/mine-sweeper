<?php
namespace BrowserGames\GridGames;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

use Generics\Cell;
use Generics\AbstractGame;
use Generics\Difficulty;

abstract class AbstractGridGame extends AbstractGame
{
    private $columns;
    protected $grid;
    private $rows;

    public function __construct(string $name, GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        parent::__construct($name, $difficulty);

        $this->rows = $rows;
        $this->columns = $columns;
        
        $this->initializeGrid();
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
        if ($this->indexInGrid($row, $column)) {
            return $this->grid[$row][$column];
        }
    }

    public function addCell(int $row, int $column, Cell $cell): bool
    {
        if ($this->indexInGrid($row, $column)) {
            $this->grid[$row][$column] = $cell;
            return true;
        } else {
            return false;
        }
    }

    private function indexInGrid(int $row, int $column): bool
    {
        return $this->rowInGrid($row) && $this->columnInGrid($column);
    }

    private function columnInGrid(int $column): bool
    {
        $minIndex = 0;
        $maxIndex = $this->getColumns() - 1;
        
        return $minIndex <= $column && $column <= $maxIndex;
    }

    private function rowInGrid(int $row): bool
    {
        $minIndex = 0;
        $maxIndex = $this->getRows() - 1;
        
        return $minIndex <= $row && $row <= $maxIndex;
    }

    public function getValue(int $row, int $column)
    {
        return $this->getCell($row, $column)->getValue();
    }

    abstract protected function initializeGrid();
}