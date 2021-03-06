<?php

namespace BrowserGames\GridGames;

use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

use Generics\AbstractGame;

abstract class AbstractGridGame extends AbstractGame
{
    private int $rows;
    private int $columns;

    protected array $grid;

    public function __construct(string $name, GridGameDifficulty $difficulty, int $rows, int $columns)
    {
        parent::__construct($name, $difficulty);

        $this->rows = $rows;
        $this->columns = $columns;

        $this->initializeGrid();
    }

    abstract protected function initializeGrid();
    abstract protected function addCell(int $row, int $column);
    abstract public function getCell(int $row, int $column);

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    private function indexInGrid(int $row, int $column): bool
    {
        return $this->rowInGrid($row) && $this->columnInGrid($column);
    }

    private function columnInGrid(int $column): bool
    {
        $minIndex = 0;
        $maxIndex = $this->getColumns() - 1;

        return $minIndex <= $column && $column <= $maxIndex;
    }

    private function rowInGrid(int $row): bool
    {
        $minIndex = 0;
        $maxIndex = $this->getRows() - 1;

        return $minIndex <= $row && $row <= $maxIndex;
    }

    public function getValue(int $row, int $column)
    {
        return $this->getCell($row, $column)->getValue();
    }
}
