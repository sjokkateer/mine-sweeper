<?php
namespace BrowserGames\GridGames\Difficulty;

class GridGameDifficulty
{
    private $name;
    private $numberOfDefaultValues;

    public function __construct(string $name, int $numberOfDefaultValues)
    {
        $this->name = $name;
        $this->numberOfDefaultValues = $numberOfDefaultValues;
    }

    /**
     * Get the value of numberOfDefaultValues
     */ 
    public function getNumberOfDefaultValues(): int
    {
        return $this->numberOfDefaultValues;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}