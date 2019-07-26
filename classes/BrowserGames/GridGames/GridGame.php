<?php
namespace BrowserGames\GridGames;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

abstract class GridGame
{
    protected $difficulty;
    protected $grid;

    public function __construct(GridGameDifficulty $difficulty)
    {
        $this->difficulty = $difficulty;
    }
}