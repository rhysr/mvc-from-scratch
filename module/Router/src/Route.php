<?php

namespace Router;

interface Route
{
    public function isMatch(string $path): bool;

    public function match(string $path): RouteResult;
}
