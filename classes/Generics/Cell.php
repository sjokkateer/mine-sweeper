<?php
namespace Generics;

use Generics\InvalidIndexException;

abstract class Cell
{
    private $row;
    private $column;
    private $value;

    public function __construct(int $row, int $column, $value)
    {
        $this->setRow($row);
        $this->setColumn($column);
        $this->value = $value;
    }
    
    /**
     * Get the value of row
     */ 
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * Get the value of column
     */ 
    public function getColumn(): int
    {
        return $this->column;
    }

    public function __toString()
    {
        return "[{$this->row}, {$this->column}]";
    }

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     */ 
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Set the value of row
     */ 
    private function setRow($row)
    {
        if ($row >= 0) {
            $this->row = $row;
        } else {
            throw new InvalidIndexException();
        }
        
    }

    /**
     * Set the value of column
     */ 
    private function setColumn(int $column)
    {
        if ($column >= 0) {
            $this->column = $column;
        } else {
            throw new InvalidIndexException();
        }
    }
}