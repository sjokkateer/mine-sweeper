<?php
namespace BrowserGames\MineSweeper\Controllers;

class MineSweeper
{
    public function home(): array
    {
        return [
            'title' => 'test',
            'template' => 'test.html.php',
            'variables' => [
                'route' => 'minesweeper/home',
            ],
        ];
    }
}