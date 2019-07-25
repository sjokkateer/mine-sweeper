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
            'template' => 'minesweeper.html.php',
            'variables' => [
                'title' => 'Minesweeper Easy',
                'styleSheets' => [
                    'minesweeper.css'
                ],
                'scripts' => [
                    'minesweeper.js',
                ],
            ],
        ];
    }

    public function cellClicked(): array
    {
        $game = $_SESSION['game'];
        if (!$game->isGameOver()) {
            $row = $_POST['row'];
            $column = $_POST['column'];
            $game->setClicked($row, $column);
        }
        return $this->home();
    }

    public function newGame()
    {
        unset($_SESSION['game']);
        return $this->home();
    }
}