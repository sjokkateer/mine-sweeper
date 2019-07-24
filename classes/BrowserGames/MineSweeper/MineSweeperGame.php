<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class MineSweeperGame
{
    private $difficulty;
    public $mines;
    public $mineCounts;

    public function __construct(Difficulty $difficulty)
    {
        $this->difficulty = $difficulty;
        // Ensure reproducable results for now, remove after debugging.
        srand(0);
        $this->mines = $this->initializeGrid(false);
        $this->generateMines();
        $this->mineCounts = $this->initializeGrid(0);
        // Call to populate the mineCounts array based on placement of mines.
    }

    private function generateMines()
    {
        $numberOfMines = $this->difficulty->getNumberOfMines();
        $maxIndex = $this->difficulty->getRows() - 1;
        while ($numberOfMines > 0) {
            $row = rand(0, $maxIndex);
            $column = rand(0, $maxIndex);
            if (!$this->mines[$row][$column]) {
                $this->mines[$row][$column] = true;
                $numberOfMines--;
            }
        }
    }

    private function generateMineCounts()
    {
        // For each cell in the grid, calculate the number of 
        // mines that are in its neighborhood.
    }

    private function countMinesInNeighBorHood(int $row, int $column)
    {

    }

    private function indexInGrid(int $row, int $column): bool
    {
        return $this->rowInGrid($row) && $this->columnInGrid($column);
    }

    private function columnInGrid(int $column): bool
    {
        $minIndex = 0;
        $maxIndex = $this->difficulty->getColumns() - 1;
        
        return $minIndex <= $column && $column <= $maxIndex;
    }

    private function rowInGrid(int $row): bool
    {
        $minIndex = 0;
        $maxIndex = $this->difficulty->getRows() - 1;
        
        return $minIndex <= $row && $row <= $maxIndex;
    }

    private function initializeGrid($initialValue): array
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $array[$i][$j] = $initialValue;
            }
        }
        return $array;
    }

    public function getRows(): int
    {
        return $this->difficulty->getRows();
    }

    public function getColumns(): int
    {
        return $this->difficulty->getColumns();
    }

    public function getNumberOfMines(): int
    {
        return $this->difficulty->getNumberOfMines();
    }

    public function __toString(): string
    {
        $result = 'Game of minesweeper';
        $result .= '<br />';
        $result .= "difficulty: {$this->difficulty}";
        $result .= "<br />";
        $result .= "rows: {$this->getRows()} columns: {$this->getColumns()}";
        $result .= "<br />";
        $result .= "number of mines: {$this->difficulty->getNumberOfMines()}";

        return $result;
    }
}