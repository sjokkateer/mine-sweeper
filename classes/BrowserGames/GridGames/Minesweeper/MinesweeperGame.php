<?php
namespace BrowserGames\GridGames\Minesweeper;

use BrowserGames\GridGames\AbstractGridGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\Minesweeper\MinesweeperCell;

class MinesweeperGame extends AbstractGridGame
{
    private $fatalMine;
    private $gameOver;

    public function __construct(GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        parent::__construct('Minesweeper', $difficulty, $rows, $columns);
        $this->gameOver = false;
        $this->generateMines();
        $this->forEachCell('setNeighbors');
    }

    private function generateMines()
    {
        $requiredNumberOfMines = $this->getTotalNumberOfMines();
        while ($requiredNumberOfMines > 0) {
            $cell = $this->getRandomCell();
            if (get_class($cell) !== Mine::class) {
                $this->changeCellToMine($cell);
                $requiredNumberOfMines--;
            }
        }
    }

    private function getTotalNumberOfMines(): int
    {
        $difficulty = $this->getDifficulty();
        return $difficulty->getNumberOfDefaultValues();
    }

    private function getRandomCell(): MinesweeperCell
    {
        $maxRowIndex = $this->getRows() - 1;
        $maxColumnIndex = $this->getColumns() - 1;

        $row = rand(0, $maxRowIndex);
        $column = rand(0, $maxColumnIndex);

        $cell = $this->getCell($row, $column);
        return $cell;
    }

    private function changeCellToMine(MinesweeperCell $cell)
    {
        $row = $cell->getRow();
        $column = $cell->getColumn();

        $mine = new Mine($row, $column);
        $this->setCell($row, $column, $mine);
    }

    private function forEachCell(string $method)
    {
        foreach ($this->grid as $row) {
            foreach ($row as $cell) {
                $this->{$method}($cell);
            }
        }
    }

    private function countMines(MinesweeperCell $cell)
    {
        $minesCount = $cell->getMinesCount();
        foreach($cell->getNeighbors() as $neighbor) {
            if ($neighbor->isMine()) {
                $minesCount++;
            }
        }
        $cell->setMinesCount($minesCount);
    }

    private function setNeighbors(MinesweeperCell $cell)
    {
        for ($rowOffset = -1; $rowOffset <= 1; $rowOffset++) {
            for ($columnOffset = -1; $columnOffset <= 1; $columnOffset++) {
                $neighbor = $this->getNeighbor($cell, $rowOffset, $columnOffset);
                if ($neighbor !== null) {
                    $cell->addNeighbor($neighbor);
                } 
            }
        }
    }

    private function getNeighbor(MinesweeperCell $cell, int $rowOffset, int $columnOffset)
    {
        $rowIndex = $cell->getRow();
        $columnIndex = $cell->getColumn();

        $neighborRowIndex = $rowIndex + $rowOffset;
        $neighborColumnIndex =  $columnIndex + $columnOffset;

        return $this->getCell($neighborRowIndex, $neighborColumnIndex);
    }

    protected function initializeGrid()
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $cell = new MinesweeperCell($i, $j);
                $this->setCell($i, $j, $cell);
            }
        }
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
        $flagCount = $this->getDifficulty()->getNumberOfDefaultValues();
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
        $cell = $this->getCell($row, $column);
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

    public function isFlagged(int $row, int $column)
    {
        $cell = $this->getCell($row, $column);
        return $cell->isFlagged();
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
        $cell = $this->getCell($row, $column);
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
        return $this->getCell($row, $column)->isClicked();
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
        return $this->fatalMine->getRow() == $row && $this->fatalMine->getColumn() == $column;
    }
}