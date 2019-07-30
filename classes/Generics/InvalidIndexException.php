<?php
namespace Generics;

class InvalidIndexException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}