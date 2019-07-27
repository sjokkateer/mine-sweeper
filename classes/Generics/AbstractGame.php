<?php
namespace Generics;

use Generics\Difficulty;

abstract class AbstractGame
{
    private $name;
    private $difficulty;

    public function __construct(string $name, Difficulty $difficulty)
    {
        $this->name = $name;
        $this->difficulty = $difficulty;
    }

    abstract public function isWon(): bool;
    
    
    public function getDifficulty(): Difficulty
    {
        return $this->difficulty;
    }

    public function __toString()
    {
        return "{$this->name} {$this->difficulty}";
    }
}