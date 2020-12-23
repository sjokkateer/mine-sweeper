<?php

namespace BrowserGames\GridGames\Minesweeper;

use BrowserGames\GridGames\AbstractGridGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\Minesweeper\MinesweeperCell;
use Exception;

class MinesweeperGame extends AbstractGridGame
{
    private MinesweeperCell $fatalMine;
    private bool $gameOver;
    private array $mines;

    public function __construct(GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        $this->gameOver = false;
        $this->mines = [];
        parent::__construct('Minesweeper', $difficulty, $rows, $columns);
    }

    protected function initializeGrid(): void
    {
        // Is the array of the parent class that tracks
        // 
        $this->grid = [];
        $this->generateCells();
        $this->generateMines();
        $this->setNeighbors();
        $this->setMinesCount();
    }

    private function generateCells(): void
    {
        for ($rowIndex = 0; $rowIndex < $this->getRows(); $rowIndex++) {
            for ($columnIndex = 0; $columnIndex < $this->getColumns(); $columnIndex++) {
                $this->addCell($rowIndex, $columnIndex);
            }
        }
    }

    public function addCell(int $row, int $column): void
    {
        $cell = $this->getCell($row, $column);

        if ($cell === null) {
            $this->grid[] = new MinesweeperCell($row, $column);
        }
    }

    private function generateMines(): void
    {
        $requiredNumberOfMines = $this->getTotalNumberOfMines();

        while (count($this->mines) < $requiredNumberOfMines) {
            $this->generateRandomMine();
        }
    }

    private function getTotalNumberOfMines(): int
    {
        $difficulty = $this->getDifficulty();
        return $difficulty->getNumberOfDefaultValues();
    }

    private function generateRandomMine(): void
    {
        do {
            $cell = $this->getRandomCell();
        } while ($cell->isMine());

        $cell->setMine();
        $this->mines[] = $cell;
    }

    private function getRandomCell(): MinesweeperCell
    {
        $maxRowIndex = $this->getRows() - 1;
        $maxColumnIndex = $this->getColumns() - 1;

        $row = rand(0, $maxRowIndex);
        $column = rand(0, $maxColumnIndex);

        return $this->getCell($row, $column);
    }

    public function getCell(int $row, int $column): ?MinesweeperCell
    {
        foreach ($this->grid as $cell) {
            if ($cell->getRow() === $row && $cell->getColumn() === $column) {
                return $cell;
            }
        }

        return null;
    }

    private function setNeighbors(): void
    {
        foreach ($this->grid as $cell) {
            $this->addNeighboringCells($cell);
        }
    }

    private function addNeighboringCells(MinesweeperCell $cell): void
    {
        for ($rowOffset = -1; $rowOffset <= 1; $rowOffset++) {
            for ($columnOffset = -1; $columnOffset <= 1; $columnOffset++) {
                $neighbor = $this->getExistingNeighbor($cell, $rowOffset, $columnOffset);

                if ($neighbor !== null && $neighbor !== $cell) {
                    $cell->addNeighbor($neighbor);
                }
            }
        }
    }

    private function getExistingNeighbor(MinesweeperCell $cell, int $rowOffset, int $columnOffset): ?MinesweeperCell
    {
        $rowIndex = $cell->getRow();
        $columnIndex = $cell->getColumn();

        $neighborRowIndex = $rowIndex + $rowOffset;
        $neighborColumnIndex =  $columnIndex + $columnOffset;

        return $this->getCell($neighborRowIndex, $neighborColumnIndex);
    }

    private function setMinesCount(): void
    {
        foreach ($this->mines as $mine) {
            foreach ($mine->getNeighbors() as $neighbor) {
                $neighbor->incrementMinesCount();
            }
        }
    }

    public function setClicked(int $row, int $column): void
    {
        $cell = $this->getCell($row, $column);
        if (!$cell->isFlagged()) {
            $cell->setClicked();

            if ($cell->isMine()) {
                $this->endGame($cell);
            } else {
                $this->setClicksRecursively($cell);
            }
        }
    }

    private function endGame(MinesweeperCell $cell): void
    {
        $this->gameOver = true;
        $this->displayAllMines();
        $this->fatalMine = $cell;
    }

    private function setClicksRecursively(MineSweeperCell $cell): void
    {
        $cell->setClicked();
        $cell->setFlagged(false);

        if ($cell->getMinesCount() === 0) {
            foreach ($cell->getNeighbors() as $neighbor) {
                if (!$neighbor->isClicked()) {
                    $this->setClicksRecursively($neighbor);
                }
            }
        }
    }

    public function isWon(): bool
    {
        return $this->flagsLeft() == 0 && $this->allMinesFlagged();
    }

    public function flagsLeft(): int
    {
        $flagCount = $this->getDifficulty()->getNumberOfDefaultValues();
        foreach ($this->grid as $cell) {
            if ($cell->isFlagged()) {
                $flagCount--;
            }
        }
        return $flagCount;
    }

    public function isFlagged(int $row, int $column): bool
    {
        $cell = $this->getCell($row, $column);
        return $cell->isFlagged();
    }

    private function allMinesFlagged(): bool
    {
        foreach ($this->mines as $mine) {
            if (!$mine->isFlagged()) {
                return false;
            }
        }
        return true;
    }

    public function setFlagged(int $row, int $column, bool $flagged): void
    {
        $cell = $this->getCell($row, $column);
        if ($flagged && $this->flagsLeft() > 0) {
            $cell->setFlagged($flagged);
        } else {
            $cell->setFlagged($flagged);
        }
    }

    private function displayAllMines()
    {
        foreach ($this->mines as $mine) {
            $mine->setClicked();
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

    public static function create(string $difficulty): self
    {
        switch ($difficulty) {
            case GridGameDifficulty::BEGINNER:
                $diff = new GridGameDifficulty($difficulty, 10);
                $rows = 9;
                $columns = 9;
                break;
            case GridGameDifficulty::INTERMEDIATE:
                $diff = new GridGameDifficulty($difficulty, 40);
                $rows = 16;
                $columns = 16;
                break;
            case GridGameDifficulty::EXPERT:
                $diff = new GridGameDifficulty($difficulty, 99);
                $rows = 16;
                $columns = 30;
                break;
            default:
                throw new Exception("Uknown difficulty received: $difficulty");
        }

        return new static($diff, $rows, $columns);
    }

    public function printMines(): void
    {
        $totalMines = count($this->mines);
        echo "Total number of mines: $totalMines";
        echo "<br />";
        foreach ($this->mines as $mine) {
            echo "M: [{$mine->getRow()}, {$mine->getColumn()}]";
            echo '&nbsp&nbsp&nbsp';
        }
    }

    public function printCells(): void
    {
        $totalCells = count($this->grid);
        echo "Total number of cells: $totalCells";
        echo "<br />";
        for ($i = 0; $i < count($this->grid); $i++) {
            $cell = $this->grid[$i];
            echo "C: [{$cell->getRow()}, {$cell->getColumn()}]";
            echo '&nbsp&nbsp&nbsp';
            if (($i + 1) % $this->getColumns() === 0) {
                echo "<br />";
            }
        }
    }
}
