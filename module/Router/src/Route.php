<?php

namespace Router;

interface Route
{
    public function isMatch(string $path): bool;
}
