<?php
namespace BrowserGames;

use BrowserGames\Controllers\MineSweeper;
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
            $controller = new MineSweeper();
            $page = $controller->home();
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