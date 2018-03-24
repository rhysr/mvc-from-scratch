<?php

namespace Router;

interface Route
{
    public function match(string $path): RouteResult;
}
