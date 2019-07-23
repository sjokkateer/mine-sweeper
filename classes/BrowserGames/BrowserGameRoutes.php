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
                'action' => '',
            ],
        ],
    ];

    public function callAction(string $route): array
    {
        $page = [];
        switch($route) {
            case 'minesweeper/home':
            $routes = $this->getRoutes();
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $requestedAction = $routes["$route"]["$requestMethod"];
            
            $namespace = 'BrowserGames\MineSweeper\Controllers\\';
            $controller =  $namespace . $requestedAction['controller'];
            $controller = new $controller();
            $action = $requestedAction['action'];
            
            $page = $controller->$action();
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
}