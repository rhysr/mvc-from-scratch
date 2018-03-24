<?php

namespace Router;

final class RouteResult
{
    private $success;

    private $routeParams;

    public function __construct(bool $success, array $routeParams = [])
    {
        $this->success = $success;
        $this->routeParams = $routeParams;
    }

    public function isMatch(): bool
    {
        return $this->success;
    }

    public function getParams(): array
    {
        return $this->routeParams;
    }
}
