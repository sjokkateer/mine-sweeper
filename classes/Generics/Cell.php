<?php

namespace Generics;

use Generics\InvalidIndexException;

abstract class Cell
{
    private int $row;
    private int  $column;
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
     * Set the value of row
     */
    private function setRow($row)
    {
        if ($row < 0) {
            throw new InvalidIndexException();
        }

        $this->row = $row;
    }

    /**
     * Get the value of column
     */
    public function getColumn(): int
    {
        return $this->column;
    }

    /**
     * Set the value of column
     */
    private function setColumn(int $column)
    {
        if ($column < 0) {
            throw new InvalidIndexException();
        }

        $this->column = $column;
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

    public function __toString()
    {
        return "[{$this->row}, {$this->column}]";
    }
}
