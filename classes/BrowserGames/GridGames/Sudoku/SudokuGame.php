<?php
namespace BrowserGames\GridGames\Sudoku;

use BrowserGames\GridGames\AbstractGridGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;
use BrowserGames\GridGames\Sudoku\SudokuCell;

use Generics\Index;

class SudokuGame extends AbstractGridGame
{
    private $quadrants;

    public function __construct(GridGameDifficulty $difficulty, int $rows = 9, int $columns = 9)
    {
        parent::__construct('Sudoku', $difficulty, $rows, $columns);
        srand(0);
        $this->generateNumbers();
    }

    protected function initializeGrid()
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $cell = new SudokuCell($i, $j);
                $this->setCell($i, $j, $cell);
                $this->determineQuadrant($cell);
            }
        }
    }

    private function determineQuadrant(SudokuCell $cell)
    {
        $quadrantRow = intdiv($cell->getRow(), 3);
        $quadrantColumn = intdiv($cell->getColumn(), 3);
        $quadrantIndex = new Index($quadrantRow, $quadrantColumn);
        $cell->setQuadrantIndex($quadrantIndex);
        $this->quadrants[$quadrantRow][$quadrantColumn][] = $cell;
    }

    private function generateNumbers()
    {
        $maxRowIndex = $this->getRows() - 1;
        $maxColumnIndex = $this->getColumns() - 1;
        $randomValuesGenerated = $this->getDifficulty()->getNumberOfDefaultValues();
        while ($randomValuesGenerated > 0) {
            $row = rand(0, $maxRowIndex);
            $column = rand(0, $maxColumnIndex);
            $cell = $this->getCell($row, $column);
            if (!$cell->isInitialized()) {
                do {
                    $generatedValue = rand(1, 9);
                } while (!$this->valueIsAllowed($cell, $generatedValue));
                $this->setValue($row, $column, $generatedValue);
                $cell->initialize();
                $randomValuesGenerated--;
            }
        }
    }

    public function valueIsAllowed(SudokuCell $cell, int $value)
    {
        $row = $cell->getRow();
        $column = $cell->getColumn();

        return $this->valueIsAllowedInRowAndColumn($row, $column, $value) &&
                    $this->valueIsAllowedInQuadrant($cell, $value);
    }

    public function isWon(): bool
    {
        return false;
    }

    private function valueIsAllowedInRowAndColumn(int $row, int $column, int $value)
    {
        // Since Sudokus have a fixed dimension and are square grids.
        $maxIndex = $this->getRows();
        for($i = 0; $i < $maxIndex; $i++) {
            $currentRowCell = $this->getCell($row, $i);
            $currentColumnCell = $this->getCell($i, $column);
            // Should add a check to skip the given cell later on.
            if ($currentRowCell->getValue() == $value || $currentColumnCell->getValue() == $value) {
                return false;
            }
        }
        return true;
    }

    private function valueIsAllowedInQuadrant(SudokuCell $cell, int $value)
    {
        // Determine the quadrant.
        $quadrantIndex = $cell->getQuadrantIndex();
        $quadrantRow = $quadrantIndex->getRow();
        $quadrantColumn = $quadrantIndex->getColumn();
        $quadrant = $this->quadrants[$quadrantRow][$quadrantColumn];
        // Iterate over all cells in the quadrant except for the cell itself.
        foreach($quadrant as $cell) {
            if ($cell->getValue() == $value) {
                return false;
            }
        }
        return true;
    }


    public function setValue(int $row, int $column, int $value)
    {
        $cell = $this->getCell($row, $column);
        if (!$cell->isInitialized()) {
            $cell->setValue($value);
        }
    }

    public function printIndices()
    {
        $columnCount = 0;
        $rowCount = 0;
        foreach($this->grid as $row) {
            foreach ($row as $cell) {
                echo $cell->getQuadrantIndex() . ' ';
                $columnCount++;

                if ($columnCount % 3 == 0) {
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }

                if ($columnCount == 9) {
                    $columnCount = 0;
                    echo '<br/>';
                }
            }
            $rowCount++;
            if ($rowCount == 3) {
                $rowCount = 0;
                echo '<br/>';
            }
        }
    }
}