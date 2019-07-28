<?php
namespace Generics;

class Index
{
    private $row;
    private $column;

    public function __construct(int $row, int $column)
    {
        $this->row = $row;
        $this->column = $column;
    }
    
    /**
     * Get the value of row
     */ 
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Get the value of column
     */ 
    public function getColumn()
    {
        return $this->column;
    }
}