<?php

namespace HttpTest;

use Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testCanReturnResponseCode()
    {
        $response = new Response(200, [], '');
        $this->assertEquals(200, $response->getResponseCode());
    }


    public function testSettingResponseCodeGreaterThan599ThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid response code \'999\'');
        $response = new Response(999, [], '');
    }

    public function testSettingResponseCodeLessThan100ThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid response code \'99\'');
        $response = new Response(99, [], '');
    }

    public function testCanGetHeaderLines()
    {
        $response = new Response(200, [
            'Etag'          => '5a682fce-fd96',
            'Last-Modified' => 'Wed, 24 Jan 2018 07:03:42 GMT',
            'Server'        => 'nginx/1.12.2'
        ], '');
        $headers = $response->getHeaderLines();
        $this->assertInternalType('array', $headers);
        $this->assertCount(3, $headers);
        $this->assertContains('Etag: 5a682fce-fd96', $headers);
        $this->assertContains('Last-Modified: Wed, 24 Jan 2018 07:03:42 GMT', $headers);
        $this->assertContains('Server: nginx/1.12.2', $headers);
    }

    public function testCanGetBody()
    {
        $response = new Response(200, [], 'CONTENT');
        $this->assertEquals('CONTENT', $response->getBody());
    }
}
