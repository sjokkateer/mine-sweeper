<?php
use Generics\Cell;
use Generics\InvalidIndexException;
use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
    /**
     * @dataProvider constructionProvider
     */
    public function testConstruction(int $row, int $column, $expected = null) 
    {
        if ($row < 0 || $column < 0) {
            $this->expectException($expected);
            new class($row, $column) extends Cell {
                public function __construct(int $row, int $column) 
                {
                    parent::__construct($row, $column, 0);
                }
            };
        } else {
            $cell = new class($row, $column) extends Cell {
                public function __construct(int $row, int $column) 
                {
                    parent::__construct($row, $column, 0);
                }
            };
            $this->assertSame($row, $cell->getRow());
            $this->assertSame($column, $cell->getColumn());
        }
    }

    public function constructionProvider()
    {
        return [
            [-1, 0, InvalidIndexException::class],
            [0, -1, InvalidIndexException::class],
            [-1, -1, InvalidIndexException::class],
            [0, 0],
            [rand(0, 10000), rand(0, 10000)],
            [0, rand(0, 10000)],
            [rand(0, 10000), 0],
        ];
    }
}