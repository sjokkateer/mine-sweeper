<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class DifficultyEasy extends Difficulty
{
    public function __construct()
    {
        parent::__construct(10, 9, 9);
    }

    public function __toString(): string
    {
        return "Easy";
    }
}