<?php
namespace BrowserGames\GridGames\Sudoku;

use Generics\Cell;
use Generics\Index;

class SudokuCell extends Cell
{
    private $initalized;
    private $quadrant;

    public function __construct(int $row, int $column)
    {
        parent::__construct($row, $column, 0);
        $this->initalized = false;
    }

    public function setValue($value)
    {
        if ($value >= 1 && $value <= 9) {
            parent::setValue($value);
        }
    }

    public function initialize()
    {
        $this->initalized = true;
    }

    public function isInitialized()
    {
        return $this->initalized;
    }

    /**
     * Set the value of quadrant
     */ 
    public function setQuadrantIndex(Index $quadrant)
    {
        $this->quadrant = $quadrant;
    }

    /**
     * Get the value of quadrant
     */ 
    public function getQuadrantIndex(): Index
    {
        return $this->quadrant;
    }
}