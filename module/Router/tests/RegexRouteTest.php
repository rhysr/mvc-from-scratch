<?php

namespace RouterTest;

use Router\RegexRoute;

use PHPUnit\Framework\TestCase;

class RegexRouteTest extends TestCase
{
    public function testReturnBooleanWhenPathMatches()
    {
        $route = $this->createRoute('#^/thing/\d+$#');
        $this->assertTrue($route->isMatch('/thing/1234'));
    }

    public function testReturnBooleanWhenPathDoesntMatch()
    {
        $route = $this->createRoute('#/user/\d+$#');
        $this->assertFalse($route->isMatch('/somewhere-else'));
    }

    private function createRoute(string $path)
    {
        return new RegexRoute($path);
    }
}
