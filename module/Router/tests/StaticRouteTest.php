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

    public function testReturnBooleanWhenPathMatches()
    {
        $route = $this->createRoute('/');
        $this->assertTrue($route->isMatch('/'));
    }

    public function testReturnBooleanWhenPathDoesntMatch()
    {
        $route = $this->createRoute('/super-awesome');
        $this->asserTFalse($route->isMatch('/does-not-exist'));
    }

    private function createRoute(string $path)
    {
        return new StaticRoute($path);
    }
}
