<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class MineSweeperGame
{
    private $difficulty;
    private $mines;
    private $minesCount;

    public function __construct(Difficulty $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function getRows(): int
    {
        return $this->difficulty->getRows();
    }

    public function getColumns(): int
    {
        return $this->difficulty->getColumns();
    }

    public function getNumberOfMines(): int
    {
        return $this->difficulty->getNumberOfMines();
    }

    public function __toString(): string
    {
        $result = 'Game of minesweeper';
        $result .= '<br />';
        $result .= "difficulty: {$this->difficulty}";
        $result .= "<br />";
        $result .= "rows: {$this->getRows()} columns: {$this->getColumns()}";
        $result .= "<br />";
        $result .= "number of mines: {$this->difficulty->getNumberOfMines()}";

        return $result;
    }
}