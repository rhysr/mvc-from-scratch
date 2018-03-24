<?php

namespace RouterTest;

use Router\StaticRoute;

use PHPUnit\Framework\TestCase;

class StaticRouteTest extends TestCase
{
    public function testImplementsRouteTest()
    {
        $route = $this->createRoute('/');
        $this->assertInstanceOf(\Router\Route::class, $route);
    }

    public function testReturnsRouteResultWhenMatching()
    {
        $route = $this->createRoute('/super-awesome');
        $match = $route->match('/does-not-exist');
        $this->assertInstanceOf(\Router\RouteResult::class, $match);
    }

    public function testMatchingPathsReturnsPositiveResult()
    {
        $route = $this->createRoute('/matching');
        $match = $route->match('/matching');
        $this->assertTrue($match->isMatch());
    }

    public function testNonMatchingPathsReturnsNegativeResult()
    {
        $route = $this->createRoute('/super-awesome');
        $match = $route->match('/does-not-exist');
        $this->assertFalse($match->isMatch());
    }

    public function testReturnsEmptyRouteParams()
    {
        $route = $this->createRoute('/matching');
        $match = $route->match('/matching');
        $this->assertCount(0, $match->getParams());
    }

    private function createRoute(string $path)
    {
        return new StaticRoute($path);
    }
}
