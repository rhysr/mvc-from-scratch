<?php

namespace Router;

final class RegexRoute implements Route
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function match(string $path): RouteResult
    {
        $success = (bool) preg_match($this->path, $path);
        return new RouteResult($success);
    }
}
