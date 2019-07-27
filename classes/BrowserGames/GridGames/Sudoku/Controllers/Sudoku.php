<?php
namespace BrowserGames\GridGames\Sudoku\Controllers;

use BrowserGames\GridGames\Sudoku\SudokuGame;
use BrowserGames\GridGames\Difficulty\GridGameDifficulty;

class Sudoku
{
    public function home()
    {
        if (!isset($_SESSION['sudokuGame'])) {
            $_SESSION['sudokuGame'] = new SudokuGame(new GridGameDifficulty('Easy', 32));
        }
        return [
            'template' => 'sudoku.html.php',
            'variables' => [
                'title' => 'Sudoku Easy',
                // 'styleSheets' => [
                //     ''
                // ],
                // 'scripts' => [
                //     '',
                // ],
            ],
        ]; 
    }
}