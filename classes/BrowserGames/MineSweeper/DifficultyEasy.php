<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeperDifficulty;

class DifficultyEasy extends MineSweeperDifficulty
{
    public function __construct()
    {
        parent::__construct(10, 8, 8);
    }
}