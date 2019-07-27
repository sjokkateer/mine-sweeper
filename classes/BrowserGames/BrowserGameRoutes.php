<?php
namespace BrowserGames;

use Generics\Routes;

class BrowserGameRoutes implements Routes
{
    private const HOME ='?route=sudoku/home';
    private const ROUTES = [
        'minesweeper/home' => [
            'GET' => [
                'controller' => 'Minesweeper',
                'action' => 'home',
            ],
            'POST' => [
                'controller' => 'Minesweeper',
                'action' => 'cellClicked',
            ],
        ],
        'minesweeper/newgame' => [
            'POST' => [
                'controller' => 'Minesweeper',
                'action' => 'newGame',
            ],
        ],
        'minesweeper/setflag' => [
            'POST' => [
                'controller' => 'Minesweeper',
                'action' => 'setFlag',
            ],
        ],
        'sudoku/home' => [
            'GET' => [
                'controller' => 'Sudoku',
                'action' => 'home',
            ],
            'POST' => [
                'controller' => 'Sudoku',
                'action' => 'checkSolution',
            ],
        ],
    ];

    public function callAction(string $route): array
    {
        $page = [];
        switch($route) {
            case 'minesweeper/home':
                $namespace = 'BrowserGames\GridGames\Minesweeper\Controllers\\';
                session_start();
                $page = $this->handleAction($route, $namespace);
                break;
            case 'minesweeper/newgame':
                $namespace = 'BrowserGames\GridGames\Minesweeper\Controllers\\';
                session_start();
                $page = $this->handleAction($route, $namespace);
                break;
            case 'minesweeper/setflag':
                $namespace = 'BrowserGames\GridGames\Minesweeper\Controllers\\';
                session_start();
                $page = $this->handleAction($route, $namespace);
                break;
            case 'sudoku/home':
                $namespace = 'BrowserGames\GridGames\Sudoku\Controllers\\';
                session_start();
                $page = $this->handleAction($route, $namespace);
                break;
        }
        return $page;
    }

    public function getHome(): string
    {
        return self::HOME;
    }

    public function getRoutes(): array
    {
        return self::ROUTES;
    }

    private function handleAction(string $route, string $namespace)
    {
        $routes = $this->getRoutes();
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestedAction = $routes["$route"]["$requestMethod"];
        $controller =  $namespace . $requestedAction['controller'];
        $controller = new $controller();
        $action = $requestedAction['action'];
        return $controller->$action();
    }
}