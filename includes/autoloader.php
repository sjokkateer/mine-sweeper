<?php
function autoload($className)
{
    include __DIR__ . "/../classes/$className.php";
}