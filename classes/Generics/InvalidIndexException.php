<?php
namespace Generics;

class InvalidIndexException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}