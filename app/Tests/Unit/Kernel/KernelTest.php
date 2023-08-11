<?php

namespace DevelopersNL\Tests\Unit\Kernel;

use DevelopersNL\Kernel\Kernel;
use DevelopersNL\Request\Request;
use DevelopersNL\Request\Route;
use DevelopersNL\Response\ContentResponse;
use DevelopersNL\Response\ViewInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Kernel\Kernel
 */
class KernelTest extends TestCase
{
    protected MockObject|Route $route;
    protected Kernel $kernel;

    public function setUp(): void
    {
        $this->route = $this->createMock(Route::class);
        $this->kernel = new Kernel([ $this->route ]);
    }

    public function testExistingPathWithResultingView(): void
    {
        $view = $this->createMock(ViewInterface::class);
        $request = $this->createMock(Request::class);

        $this->route
            ->expects($this->once())
            ->method('matches')
            ->with($request)
            ->willReturn(true);

        $this->route
            ->expects($this->once())
            ->method('control')
            ->with($request)
            ->willReturn($view);

        $response = $this->kernel->handle($request);

        $this->assertSame($view, $response->view);
        $this->assertSame(200, $response->responseCode);
    }

    public function testExistingPathWithResultingResponse(): void
    {
        $response = $this->createMock(ContentResponse::class);
        $request = $this->createMock(Request::class);

        $this->route
            ->expects($this->once())
            ->method('matches')
            ->with($request)
            ->willReturn(true);

        $this->route
            ->expects($this->once())
            ->method('control')
            ->with($request)
            ->willReturn($response);

        $actualResponse = $this->kernel->handle($request);

        $this->assertSame($response, $actualResponse);
    }

    public function testNotExisitingPathYields404(): void
    {
        $request = $this->createMock(Request::class);

        $this->route
            ->expects($this->once())
            ->method('matches')
            ->with($request)
            ->willReturn(false);

        $response = $this->kernel->handle($request);

        $this->assertSame(404, $response->responseCode);
    }
}
