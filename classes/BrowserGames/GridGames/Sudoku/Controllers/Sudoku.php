<?php
namespace BrowserGames\GridGames\Sudoku\Controllers;

use BrowserGames\GridGames\Sudoku\SudokuGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

class Sudoku
{
    private const GAME_NAME = 'sudoku';

    public function home()
    {
        if (!isset($_SESSION[self::GAME_NAME])) {
            $_SESSION[self::GAME_NAME] = new SudokuGame(new GridGameDifficulty('Easy', 32));
        }
        return [
            'template' => self::GAME_NAME . '.html.php',
            'variables' => [
                'title' => $_SESSION[self::GAME_NAME],
                'styleSheets' => [
                    self::GAME_NAME . '.css',
                ],
                'scripts' => [
                    '',
                ],
            ],
        ]; 
    }

    public function checkSolution()
    {
        
    }
}