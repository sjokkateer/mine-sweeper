<?php

use Generics\EntryPoint;
use BrowserGames\BrowserGameRoutes;

require_once __DIR__ . '/vendor/autoload.php';

$route = $_GET['route'] ?? '';

$entryPoint = new EntryPoint($route, new BrowserGameRoutes());
$entryPoint->run();
