<?php

namespace HttpTest;

use \Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testCanGetPath()
    {
        $request = new Request('/foo');
        $this->assertEquals('/foo', $request->getPath());
    }

    public function testCanAddParams()
    {
        $request = new Request('/');
        $request->addParam('foo', 'bar');
        $request->addParam('omg', 'a shark');
        $params = $request->getParams();
        $this->assertInternalType('array', $params);
        $this->assertCount(2, $params);
        $this->assertArrayHasKey('foo', $params);
        $this->assertArrayHasKey('omg', $params);
        $this->assertEquals('bar', $params['foo']);
        $this->assertEquals('a shark', $params['omg']);
    }
}
