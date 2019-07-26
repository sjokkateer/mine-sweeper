<?php
namespace BrowserGames\GridGames\Minesweeper;

use BrowserGames\GridGames\GridGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\Minesweeper\MinesweeperCell;

class MinesweeperGame extends GridGame
{
    private $fatalMine;
    private $gameOver;

    public function __construct(GridGameDifficulty $difficulty)
    {
        parent::__construct($difficulty);
        $this->grid = $this->initializeGrid();
        $this->gameOver = false;
        // Ensure reproducable results for now, remove after debugging.
        // srand(0);
        $this->generateMines();
        $this->countMinesInNeighborhood();
    }

    private function generateMines()
    {
        $numberOfMines = $this->difficulty->getNumberOfDefaultValues();
        $maxRowIndex = $this->difficulty->getRows() - 1;
        $maxColumnIndex = $this->difficulty->getColumns() - 1;
        while ($numberOfMines > 0) {
            $row = rand(0, $maxRowIndex);
            $column = rand(0, $maxColumnIndex);
            if (!$this->grid[$row][$column]->isMine()) {
                $this->grid[$row][$column]->setMine();
                $numberOfMines--;
            }
        }
    }

    private function countMinesInNeighborhood()
    {
        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                $this->setNeighbors($cell);
                $this->countMines($cell);
            }
        }
    }

    private function countMines(MinesweeperCell $cell)
    {
        foreach($cell->getNeighbors() as $neighbor) {
            if ($neighbor->isMine()) {
                $newCount = $cell->getMinesCount() + 1;
                $cell->setMinesCount($newCount);
            }
        }
    }

    private function setNeighbors(MinesweeperCell $cell)
    {
        $rowIndex = $cell->getIndex()->getRow();
        $columnIndex = $cell->getIndex()->getColumn();
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                $row = $rowIndex + $i;
                $column =  $columnIndex + $j;
                if ($this->indexInGrid($row, $column)) {
                    $neighbor = $this->grid[$row][$column];
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
                $array[$i][$j] = new MinesweeperCell($i, $j);
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
        return $this->difficulty->getNumberOfDefaultValues();
    }

    public function outputCells()
    {
        foreach ($this->grid as $row) {
            foreach($row as $cell) {
                echo $cell;
            }
            echo '<br />';
        }
    }

    public function getFlagCount(): int
    {
        $flagCount = $this->difficulty->getNumberOfDefaultValues();
        foreach ($this->grid as $row) {
            foreach($row as $cell) {
                if ($cell->isFlagged()) {
                    $flagCount--;
                }
            }
        }
        return $flagCount;
    }

    public function setClicked(int $row, int $column)
    {
        $cell = $this->grid[$row][$column];
        if (!$cell->isFlagged()) {
            $cell->setClicked();
            if ($cell->isMine()) {
                $this->gameOver = true;
                $this->displayAllMines();
                $this->fatalMine = $cell;
            } else {
                $this->handleClicksRecursively($cell);
            }
        }
    }

    public function isWon(): bool
    {
        return $this->getFlagCount() == 0 && $this->allMinesFlagged();
    }

    private function allMinesFlagged(): bool
    {
        foreach($this->grid as $row) {
            foreach ($row as $cell) {
                if ($cell->isMine()) {
                    if (!$cell->isFlagged()) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function setFlagged(int $row, int $column, bool $flagged)
    {
        $cell = $this->grid[$row][$column];
        switch($flagged) {
            case true:
                if ($this->getFlagCount() > 0) {
                    $cell->setFlagged($flagged);
                }
                break;
            case false:
                $cell->setFlagged($flagged);
                break;
        }
    }

    private function displayAllMines()
    {
        foreach($this->grid as $row) {
            foreach($row as $cell) {
                if ($cell->isMine()) {
                    $cell->setClicked();
                }
            }
        }
    }

    private function handleClicksRecursively(MineSweeperCell $cell)
    {
        $cell->setClicked();
        $cell->setFlagged(false);
        if ($cell->getMinesCount() === 0) {
            foreach ($cell->getNeighbors() as $neighbor) {
                if (!$neighbor->isClicked()) {
                    $this->handleClicksRecursively($neighbor);
                }
            }
        }
    }

    public function isClicked(int $row, int $column): bool
    {
        return $this->grid[$row][$column]->isClicked();
    }

    public function __toString(): string
    {
        $result = 'Game of minesweeper';
        $result .= '<br />';
        $result .= "difficulty: {$this->difficulty}";
        $result .= "<br />";
        $result .= "rows: {$this->getRows()} columns: {$this->getColumns()}";
        $result .= "<br />";
        $result .= "number of mines: {$this->difficulty->getNumberOfDefaultValues()}";

        return $result;
    }

    /**
     * Get the value of gameOver
     */ 
    public function isGameOver(): bool
    {
        return $this->gameOver;
    }

    public function isFatalMine(int $row, int $column): bool
    {
        $fatalMineIndex = $this->fatalMine->getIndex(); 
        return $fatalMineIndex->getRow() == $row && $fatalMineIndex->getColumn() == $column;
    }

    /**
     * Get the value of mines
     */ 
    public function getMines(): array
    {
        return $this->grid;
    }

    /**
     * Get the cell at $row index, $column index in the mines array
     */ 
    public function getCell(int $row, int $column): MinesweeperCell
    {
        return $this->grid[$row][$column];
    }
}