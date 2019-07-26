<?php
namespace BrowserGames\GridGames\Minesweeper\Controllers;

use BrowserGames\GridGames\Minesweeper\MinesweeperGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficultyEasy;

class Minesweeper
{
    public function home(): array
    {
        if (!isset($_SESSION['minesweeper'])) {
            $_SESSION['minesweeper'] = new MinesweeperGame(new GridGameDifficultyEasy(10, 9, 9));
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
        $game = $_SESSION['minesweeper'];
        if (!$game->isGameOver()) {
            $row = $_POST['row'];
            $column = $_POST['column'];
            $game->setClicked($row, $column);
        }
        return $this->home();
    }

    public function newGame()
    {
        unset($_SESSION['minesweeper']);
        return $this->home();
    }

    public function setFlag()
    {
        $game = $_SESSION['minesweeper'];
        if (!$game->isGameOver()) {
            $row = $_POST['row'];
            $column = $_POST['column'];
            $flagged = $_POST['flagged'];

            $game->setFlagged($row, $column, $flagged);
        }
        return $this->home();
    }
}