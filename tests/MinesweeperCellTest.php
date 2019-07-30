<?php
use BrowserGames\GridGames\Minesweeper\InvalidMinesCountException;
use BrowserGames\GridGames\Minesweeper\MinesweeperCell;
use PHPUnit\Framework\TestCase;

class MinesweeperCellTest extends TestCase
{
    public function testClickCell()
    {
        $cell = new MinesweeperCell(0, 0);
        $this->assertFalse($cell->isClicked());

        $cell->setClicked();
        $this->assertTrue($cell->isClicked());
    }

    /**
     * @dataProvider minesCountProvider
     */
    public function testMinesCount(int $numberOfMines, $expected)
    {
        $cell = new MinesweeperCell(0, 0);
        if ($numberOfMines < 0) {
            $this->expectException($expected);
            $cell->setMinesCount($numberOfMines);
        } else {
            $cell->setMinesCount($numberOfMines);
            $this->assertSame($expected, $cell->getMinesCount());
        }
    }

    public function testFlagCell()
    {
        $cell = new MinesweeperCell(0, 0);
        $this->assertFalse($cell->isFlagged());
        
        $cell->setFlagged(true);
        $this->assertTrue($cell->isFlagged());

        $cell->setFlagged(false);
        $this->assertFalse($cell->isFlagged());
    }

    public function testSetMine()
    {
        $cell = new MinesweeperCell(0, 0);
        $this->assertFalse($cell->isMine());

        $cell->setMine();
        $this->assertTrue($cell->isMine());
    }

    public function minesCountProvider()
    {
        return [
            [0, 0],
            [-1, InvalidMinesCountException::class],
            [5, 5],  
        ];
    }
}