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
        $success = (bool) preg_match($this->path, $path, $matches);
        if ($success) {
            $matches = $this->filterMatches($matches);
        }
        return new RouteResult($success, $matches);
    }

    /**
     * Filter non-named group matches
     */
    private function filterMatches(array $matches)
    {
        $filtered = [];
        foreach ($matches as $key => $value) {
            // All non-named group matches are integers
            // named regex groups cannot start with an integer
            // Therefore, this is not a named group
            if (is_int($key)) {
                continue;
            }
            $filtered[$key] = $value;
        }
        return $filtered;
    }
}
