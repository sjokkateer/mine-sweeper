<?php
function autoload($className)
{
    $fileName = str_replace('\\', '/', $className) . '.php';
    $file = __DIR__ . "/../classes/$fileName";
    include $file;
}