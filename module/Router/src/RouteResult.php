<?php

namespace Router;

class RouteResult
{
    private $success;

    public function __construct(bool $success)
    {
        $this->success = $success;
    }

    public function isMatch(): bool
    {
        return $this->success;
    }
}
