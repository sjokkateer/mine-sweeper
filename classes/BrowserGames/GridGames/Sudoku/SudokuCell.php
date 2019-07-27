<?php
namespace BrowserGames\GridGames\Sudoku;

use Generics\Cell;

class SudokuCell extends Cell
{
    public function __construct(int $row, int $column)
    {
        parent::__construct($row, $column, 0);
    }
}