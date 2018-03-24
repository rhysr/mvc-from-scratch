<?php

namespace RouterTest;

use Router\RegexRoute;

use PHPUnit\Framework\TestCase;

class RegexRouteTest extends TestCase
{
    public function testImplementsRouteTest()
    {
        $route = $this->createRoute('#^/\d+$#');
        $this->assertInstanceOf(\Router\Route::class, $route);
    }

    public function testReturnsRouteResultWhenMatching()
    {
        $route = $this->createRoute('#^/user/\d+$#');
        $match = $route->match('/does-not-exist');
        $this->assertInstanceOf(\Router\RouteResult::class, $match);
    }

    public function testMatchingPathsReturnsPositiveResult()
    {
        $route = $this->createRoute('#^/thing/\d+$#');
        $match = $route->match('/thing/1234');
        $this->assertTrue($match->isMatch());
    }

    public function testNonMatchingPathsReturnsNegativeResult()
    {
        $route = $this->createRoute('#^/[a-z]{3}$#');
        $match = $route->match('/stuff/1234');
        $this->assertFalse($match->isMatch());
    }

    private function createRoute(string $path)
    {
        return new RegexRoute($path);
    }
}
