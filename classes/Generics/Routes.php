<?php
namespace Generics;

interface Routes
{
    public function getHome(): string;
    public function getRoutes(): array;
}