<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class MineSweeper
{
    private $numberOfMines;
    private $mines;
    private $minesCount;

    public function __construct(Difficulty $difficulty)
    {
        $this->numberOfMines = $difficulty;
    }
}