<?php
namespace Generics;

abstract class AbstractGame
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;

    }

    abstract public function isWon(): bool;

    public function __toString()
    {
        return "{$this->name} {$this->difficulty}";
    }
}