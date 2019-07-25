<?php
namespace BrowserGames\MineSweeper\Controllers;

use BrowserGames\MineSweeper\MineSweeperGame;
use BrowserGames\MineSweeper\DifficultyEasy;

class MineSweeper
{
    public function home(): array
    {
        if (!isset($_SESSION['game'])) {
            $_SESSION['game'] = new MineSweeperGame(new DifficultyEasy());
        }
        return [
            'title' => 'Intermediate',
            'template' => 'minesweeper.html.php',
            'scripts' => [
                'minesweeper.js',
            ],
        ];
    }

    public function cellClicked(): array
    {
        $game = $_SESSION['game'];
        $row = $_POST['row'];
        $column = $_POST['column'];
        $game->setClicked($row, $column);
        return $this->home();
    }
}