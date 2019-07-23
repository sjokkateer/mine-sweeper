<?php
namespace BrowserGames\MineSweeper;

use BrowserGames\MineSweeper\Difficulty;

class MineSweeperGame
{
    private $difficulty;
    public $mines;
    private $minesCount;

    public function __construct(Difficulty $difficulty)
    {
        $this->difficulty = $difficulty;
        // Ensure reproducable results for now, remove after debugging.
        srand(0);
        $this->initializeMinesArray();
        $this->generateMines();
    }

    private function generateMines()
    {
        $numberOfMines = $this->difficulty->getNumberOfMines();
        $maxIndex = $this->difficulty->getRows() - 1;
        while ($numberOfMines > 0) {
            $row = rand(0, $maxIndex);
            $column = rand(0, $maxIndex);
            if (!$this->mines[$row][$column]) {
                $this->mines[$row][$column] = true;
                $numberOfMines--;
            }
        }
    }

    private function initializeMinesArray()
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $this->mines[$i][$j] = false;
            }
        }
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