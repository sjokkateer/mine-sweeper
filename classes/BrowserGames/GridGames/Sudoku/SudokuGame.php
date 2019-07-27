<?php
namespace BrowserGames\Sudoku;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\AbstractGridGame;

class SudokuGame extends AbstractGridGame
{
    public function __construct(GridGameDifficulty $difficulty)
    {
        parent::__construct($difficulty);
    }
}