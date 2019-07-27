<?php
namespace BrowserGames\GridGames\Sudoku;

use BrowserGames\GridGames\AbstractGridGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\Sudoku\SudokuCell;

class SudokuGame extends AbstractGridGame
{
    public function __construct(GridGameDifficulty $difficulty, int $rows = 9, int $columns = 9)
    {
        parent::__construct('Sudoku', $difficulty, $rows, $columns);
        $this->generateNumbers();
    }

    protected function initializeGrid(): array
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $array[$i][$j] = new SudokuCell($i, $j);
            }
        }
        return $array;
    }

    private function generateNumbers()
    {
        $maxRowIndex = $this->getRows() - 1;
        $maxColumnIndex = $this->getColumns() - 1;
        $randomValuesGenerated = $this->getDifficulty()->getNumberOfDefaultValues();
        while ($randomValuesGenerated > 0) {
            $row = rand(0, $maxRowIndex);
            $column = rand(0, $maxColumnIndex);
            if ()

            $randomValuesGenerated--;
        }
    }

    public function isWon(): bool
    {
        return false;
    }
}