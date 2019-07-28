<?php
namespace BrowserGames\GridGames\Sudoku;

use Generics\Cell;

class SudokuCell extends Cell
{
    private $initalized;

    public function __construct(int $row, int $column)
    {
        parent::__construct($row, $column, 0);
        $this->initalized = false;
    }

    public function setValue($value)
    {
        if ($value >= 1 && $value <= 9) {
            parent::setValue($value);
        } else {
            throw new Exception('Value must be >= 1 and <= 9');
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
}