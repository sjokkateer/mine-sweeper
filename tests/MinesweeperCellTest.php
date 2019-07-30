<?php
use BrowserGames\GridGames\Minesweeper\MinesweeperCell;
use Generics\InvalidIndexException;
use PHPUnit\Framework\TestCase;

class MinesweeperCellTest extends TestCase
{
    /**
     * @dataProvider constructionProvider
     */
    public function testConstruction(int $row, int $column, $expected) 
    {
        $this->expectException($expected);
        new MinesweeperCell($row, $column);
    }

    public function constructionProvider()
    {
        return [
            [-1, 0, Generics\InvalidIndexException::class],
            [0, -1, InvalidIndexException::class],
            [-1, -1, InvalidIndexException::class],
        ];
    }
}