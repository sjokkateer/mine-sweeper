<?php
namespace BrowserGames\GridGames\Minesweeper;

use BrowserGames\GridGames\Minesweeper\MinesweeperCell;

class Mine extends MinesweeperCell
{
    public function __toString(): string
    {
        if ($this->isClicked()) {
            return '*';
        } else {
            return parent::__toString();
        }
    }
}