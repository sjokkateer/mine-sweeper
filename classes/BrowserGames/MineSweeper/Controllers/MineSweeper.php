<?php
namespace BrowserGames\MineSweeper\Controllers;

use BrowserGames\MineSweeper\MineSweeperGame;
use BrowserGames\MineSweeper\DifficultyEasy;

class MineSweeper
{
    public function home(): array
    {
        session_start();
        $_SESSION['game'] = new MineSweeperGame(new DifficultyEasy());
        return [
            'title' => 'Easy',
            'template' => 'minesweeper.html.php',
        ];
    }
}