<?php

namespace RouterTest;

use Router\RouteResult;

use PHPUnit\Framework\TestCase;

class RouteResultTest extends TestCase
{
    public function testSuccessfulRouteMatchReturnsPositiveIsMatch()
    {
        $result = new RouteResult(true);
        $this->assertTrue($result->isMatch());
    }

    public function testUnsuccessfulRouteMatchReturnsNegativeIsMatch()
    {
        $result = new RouteResult(false);
        $this->assertFalse($result->isMatch());
    }

    private function createRoute(string $path)
    {
        return new RouteResult();
    }
}
