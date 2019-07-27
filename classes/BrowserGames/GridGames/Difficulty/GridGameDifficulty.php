<?php
namespace BrowserGames\GridGames\Difficulty;

use Generics\Difficulty;

class GridGameDifficulty extends Difficulty
{
    private $numberOfDefaultValues;

    public function __construct(string $name, int $numberOfDefaultValues)
    {
        parent::__construct($name);
        $this->numberOfDefaultValues = $numberOfDefaultValues;
    }

    /**
     * Get the value of numberOfDefaultValues
     */ 
    public function getNumberOfDefaultValues(): int
    {
        return $this->numberOfDefaultValues;
    }
}