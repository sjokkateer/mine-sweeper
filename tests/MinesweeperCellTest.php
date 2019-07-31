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
    public function testMinesCount(int $numberOfIncrements, $expected)
    {
        $cell = new MinesweeperCell(0, 0);
        for($i = 0; $i < $numberOfIncrements; $i++) {
            $cell->incrementMinesCount();
        }

        if ($numberOfIncrements > 0) {
            $this->assertSame($cell->getMinesCount(), $numberOfIncrements);
        } else {
            $this->assertSame($cell->getMinesCount(), 0);
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
            [-1, 0],
            [5, 5],  
        ];
    }
}