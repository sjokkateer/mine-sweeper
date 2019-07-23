<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class DifficultyEasy extends Difficulty
{
    public function __construct()
    {
        parent::__construct(10, 8, 8);
    }

    public function __toString(): string
    {
        return "Easy";
    }
}