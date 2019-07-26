<?php
namespace BrowserGames\GridGames\Difficulty;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

class DifficultyIntermediate extends GridGameDifficulty
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