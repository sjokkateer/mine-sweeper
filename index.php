<?php
use Generics\EntryPoint;
use BrowserGames\BrowserGameRoutes;

include __DIR__ . '/includes/autoloader.php';
spl_autoload_register('autoload');

$route = $_GET['route'] ?? '';

$entryPoint = new EntryPoint($route, new BrowserGameRoutes());
$entryPoint->run();