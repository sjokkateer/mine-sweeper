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
        // $this->generateNumbers();
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

    public function isWon(): bool
    {
        return false;
    }
}