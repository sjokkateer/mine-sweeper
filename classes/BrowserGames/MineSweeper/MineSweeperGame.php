<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;
use BrowserGames\MineSweeper\MineSweeperCell;

class MineSweeperGame
{
    private $difficulty;
    public $mines;

    public function __construct(Difficulty $difficulty)
    {
        $this->difficulty = $difficulty;
        // Ensure reproducable results for now, remove after debugging.
        srand(0);
        $this->mines = $this->initializeGrid();
        $this->generateMines();
        $this->countMinesInNeighborhood();
    }

    private function generateMines()
    {
        $numberOfMines = $this->difficulty->getNumberOfMines();
        $maxIndex = $this->difficulty->getRows() - 1;
        while ($numberOfMines > 0) {
            $row = rand(0, $maxIndex);
            $column = rand(0, $maxIndex);
            if (!$this->mines[$row][$column]->isMine()) {
                $this->mines[$row][$column]->setMine();
                $numberOfMines--;
            }
        }
    }

    private function countMinesInNeighborhood()
    {
        foreach ($this->mines as $row) {
            foreach ($row as $cell) {
                // First add all neighbors of the cell.
                $this->setNeighbors($cell);
                // Count how many of the cell's neighbors are mines.
                $this->countMines($cell);
            }
        }
    }

    private function countMines(MineSweeperCell $cell)
    {
        foreach($cell->getNeighbors() as $neighbor) {
            if ($neighbor->isMine()) {
                $newCount = $cell->getMinesCount() + 1;
                $cell->setMinesCount($newCount);
            }
        }
    }

    private function setNeighbors(MineSweeperCell $cell)
    {
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                $row = $cell->getIndex()->getRow() + $i;
                $column = $cell->getIndex()->getColumn() + $j;
                if ($this->indexInGrid($row, $column)) {
                    $neighbor = $this->mines[$row][$column];
                    $cell->addNeighbor($neighbor);
                }
            }
        }
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

    private function initializeGrid(): array
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $array[$i][$j] = new MineSweeperCell($i, $j);
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

    public function outputCells()
    {
        foreach ($this->mines as $mines) {
            foreach($mines as $mine) {
                echo $mine;
            }
            echo '<br />';
        }
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