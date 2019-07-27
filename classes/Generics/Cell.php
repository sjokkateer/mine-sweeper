<?php
namespace Generics;

use Generics\Index;

abstract class Cell
{
    private $index;
    protected $value;

    public function __construct(int $row, int $column, $value)
    {
        $this->index = new Index($row, $column);
        $this->value = $value;
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