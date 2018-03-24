<?php

namespace Router;

final class StaticRoute implements Route
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function isMatch(string $path): bool
    {
        return $path === $this->path;
    }

    public function match(string $path): RouteResult
    {
        $match = $path === $this->path;
        return new RouteResult($match);
    }
}