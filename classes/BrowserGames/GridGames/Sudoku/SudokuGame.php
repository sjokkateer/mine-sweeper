<?php
namespace BrowserGames\GridGames\Sudoku;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\AbstractGridGame;

class SudokuGame extends AbstractGridGame
{
    public function __construct(GridGameDifficulty $difficulty, int $rows = 9, int $columns = 9)
    {
        parent::__construct('Sudoku', $difficulty, $rows, $columns);
    }
}