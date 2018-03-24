<?php

namespace Router;

final class StaticRoute
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function isMatch(string $path)
    {
        return $path === $this->path;
    }
}
