<?php

namespace Http;


final class Request
{
    private $path;
    private $params = [];

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function addParam(string $name, $value): void
    {
        $this->params[$name] = $value;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
