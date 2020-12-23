<?php

namespace BrowserGames\GridGames\Difficulty;

use Exception;
use Generics\Difficulty;

class GridGameDifficulty extends Difficulty
{
    const BEGINNER = 'Beginner';
    const INTERMEDIATE = 'Intermediate';
    const EXPERT = 'Expert';

    private $numberOfDefaultValues;

    public function __construct(string $name, int $numberOfDefaultValues)
    {
        parent::__construct($name);
        $this->setNumberOfDefaultValues($numberOfDefaultValues);
    }

    /**
     * Get the value of numberOfDefaultValues
     */
    public function getNumberOfDefaultValues(): int
    {
        return $this->numberOfDefaultValues;
    }

    private function setNumberOfDefaultValues(int $value)
    {
        if ($value >= 0) {
            $this->numberOfDefaultValues = $value;
        } else {
            throw new Exception("Number of default values have to be >= 0, got $value");
        }
    }
}
