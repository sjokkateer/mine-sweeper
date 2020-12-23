<?php

namespace BrowserGames\GridGames\Minesweeper\Controllers;

use BrowserGames\GridGames\Minesweeper\MinesweeperGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

class Minesweeper
{
    private const GAME_NAME = 'minesweeper';
    private const ROW = 'row';
    private const COLUMN = 'column';

    public function home(): array
    {
        if (!isset($_SESSION[self::GAME_NAME])) {
            if (!isset($_POST['difficulty'])) {
                $_POST['difficulty'] = GridGameDifficulty::BEGINNER;
            }

            $difficulty = ucfirst($_POST['difficulty']);
            $_SESSION[self::GAME_NAME] = MinesweeperGame::create($difficulty);
        }

        return [
            'template' => self::GAME_NAME . '.html.php',
            'variables' => [
                'title' => "Minesweeper {$_SESSION[self::GAME_NAME]->getDifficulty()}",
                'styleSheets' => [
                    self::GAME_NAME . '.css',
                ],
                'scripts' => [
                    self::GAME_NAME . '.js',
                ],
            ],
        ];
    }

    public function cellClicked(): array
    {
        $game = $_SESSION[self::GAME_NAME];
        if (!$game->isGameOver()) {
            $row = $_POST[self::ROW];
            $column = $_POST[self::COLUMN];
            $game->setClicked($row, $column);
        }
        return $this->home();
    }

    public function newGame()
    {
        unset($_SESSION[self::GAME_NAME]);
        return $this->home();
    }

    public function setFlag()
    {
        $game = $_SESSION[self::GAME_NAME];
        if (!$game->isGameOver()) {
            $row = $_POST[self::ROW];
            $column = $_POST[self::COLUMN];
            $flagged = $_POST['flagged'];

            $game->setFlagged($row, $column, $flagged);
        }
        return $this->home();
    }
}
