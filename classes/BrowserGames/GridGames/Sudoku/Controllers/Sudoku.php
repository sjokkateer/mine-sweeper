<?php
use BrowserGames\Sudoku\SudokuGame;

class Sudoku
{
    public function home()
    {
        if (!isset($_SESSION['sudokuGame'])) {
            $_SESSION['sudokuGame'] = new SudokuGame(new DifficultyEasy());
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