<?php
namespace BrowserGames;

use Generics\Routes;

class BrowserGameRoutes implements Routes
{
    private const HOME = "?route=minesweeper/home";
    private const ROUTES = [
        'minesweeper/home' => [
            'GET' => [
                'controller' => 'MineSweeper',
                'action' => 'home',
            ],
            'POST' => [
                'controller' => 'MineSweeper',
                'action' => 'cellClicked',
            ],
        ],
        'minesweeper/newgame' => [
            'POST' => [
                'controller' => 'MineSweeper',
                'action' => 'newGame',
            ],
        ],
    ];

    public function callAction(string $route): array
    {
        $page = [];
        switch($route) {
            case 'minesweeper/home':
                $namespace = 'BrowserGames\MineSweeper\Controllers\\';
                session_start();
                $page = $this->handleAction($route, $namespace);
                break;
            case 'minesweeper/newgame':
                $namespace = 'BrowserGames\MineSweeper\Controllers\\';
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