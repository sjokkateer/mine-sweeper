<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class DifficultyIntermediate extends Difficulty
{
    public function __construct()
    {
        parent::__construct(40, 16, 16);
    }

    public function __toString(): string
    {
        return "Intermediate";
    }
}