<?php
namespace BrowserGames\GridGames\Difficulty;

use Generics\Difficulty;
use PHPUnit\Framework\Constraint\Exception;

class GridGameDifficulty extends Difficulty
{
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