<?php
namespace Generics;

use Generics\Index;

abstract class Cell
{
    private $index;

    public function __construct(int $row, int $column)
    {
        $this->index = new Index($row, $column);
    }

    /**
     * Get the value of index
     */ 
    public function getIndex(): Index
    {
        return $this->index;
    }

    public function __toString()
    {
        return $this->index->__toString();
    }
}