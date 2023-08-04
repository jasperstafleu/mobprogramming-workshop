<?php

namespace DevelopersNL\Tests\Unit\Request;

use DevelopersNL\Request\Request;
use DevelopersNL\Request\Route;
use DevelopersNL\Response\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Request\Route
 */
class RouteTest extends TestCase
{
    protected MockObject|Request $request;
    protected $matcher;
    protected $controller;

    public function setUp(): void
    {
        $this->request = $this->createMock(Request::class);
    }

    public function testMatchesCallable()
    {
        $called = false;
        $matching = mt_rand(0, 1) === 1;
        $callable = function() use (&$called, $matching) {
            $called = true;
            return $matching;
        };

        $route = new Route($callable, fn() => null);

        $this->assertEquals($route->matches($this->request), $matching);
        $this->assertTrue($called);
    }

    public function testMatchesString()
    {
        $path = (string) mt_rand();

        $route = new Route($path, fn() => null);

        $this->request->path = $path;
        $this->assertTrue($route->matches($this->request));
        $this->request->path = 'not'.$path;
        $this->assertFalse($route->matches($this->request));
    }

    public function testControl()
    {
        $response = $this->createMock(Response::class);

        $route = new Route(fn() => true, fn() => $response);

        $this->assertSame($route->control($this->request), $response);
    }
}
