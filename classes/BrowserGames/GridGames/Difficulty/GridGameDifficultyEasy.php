<?php
namespace BrowserGames\GridGames\Difficulty;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

class GridGameDifficultyEasy extends GridGameDifficulty
{
    public function __construct(int $numberOfDefaultValues, int $numberOfRows, int $numberOfColumns)
    {
        parent::__construct($numberOfDefaultValues, $numberOfRows, $numberOfColumns);
    }

    public function __toString(): string
    {
        return "Easy";
    }
}