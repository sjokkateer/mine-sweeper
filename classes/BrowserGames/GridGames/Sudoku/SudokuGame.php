<?php
namespace BrowserGames\Sudoku;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\AbstractGridGame;

class SudokuGame extends AbstractGridGame
{
    public function __construct(string $name, GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        parent::__construct($name, $difficulty, $rows, $columns);
    }
}