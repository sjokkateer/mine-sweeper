<?php
namespace BrowserGames\GridGames\Minesweeper;

class InvalidMinesCountException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}