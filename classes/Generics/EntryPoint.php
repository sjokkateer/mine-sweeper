<?php
namespace Generics;

use Generics\Routes;

class EntryPoint
{
    private $route;
    private $routes;

    public function __construct(string $route, Routes $routes)
    {
        $this->route = $route;
        $this->routes = $routes;
        $this->checkUrl();
        $this->checkUrlExistence();
    }

    private function checkUrl()
    {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('Location: ' . strtolower($this->route));
        }
    }

    private function checkUrlExistence()
    {
        if (!array_key_exists($this->route, $this->routes->getRoutes())) {
            http_response_code(404);
            header('Location: ' . $this->routes->getHome());
        }
    }

    private function loadTemplate(string $templateFile, array $variables = [])
    {
        extract($variables);
        ob_start();
        include __DIR__ . "/../../templates/$templateFile";
        return ob_get_clean();
    }

    public function run()
    {
        $page = $this->routes->callAction($this->route);
        $title = $page['title'];
        if (isset($page['variables'])) {
            $output = $this->loadTemplate($page['template'], $page['variables']);
        } else {
            $output = $this->loadTemplate($page['template']);
        }
        include __DIR__ . '/../../templates/layout.html.php';
    }
}