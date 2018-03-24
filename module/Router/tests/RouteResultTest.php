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

    public function testSuccessfulResultCanContainParams()
    {
        $result = new RouteResult(true, ['param1' => 'a var']);
        $this->assertInternalType('array', $result->getParams());
        $params = $result->getParams();
        $this->assertCount(1, $params);
        $this->assertArrayHasKey('param1', $params);
        $this->assertEquals('a var', $params['param1']);
    }

    private function createRoute(string $path)
    {
        return new RouteResult();
    }
}
