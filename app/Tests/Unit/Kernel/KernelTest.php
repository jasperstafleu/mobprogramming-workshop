<?php

namespace DevelopersNL\Tests\Unit\Kernel;

use DevelopersNL\Kernel\Kernel;
use DevelopersNL\Request\Request;
use DevelopersNL\Response\Response;
use DevelopersNL\View\DefaultHtmlView;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Kernel\Kernel
 */
class KernelTest extends TestCase
{
    protected MockObject $existingView;
    protected Kernel $kernel;

    public function setUp(): void
    {
        $this->existingView = $this->createMock(DefaultHtmlView::class);
        $this->kernel = new Kernel([
            '/path-that-exists' => fn() => $this->existingView,
        ]);
    }

    public function testExistingPath(): void
    {
        $request = $this->createMock(Request::class);
        $request->path = '/path-that-exists';

        $response = $this->kernel->handle($request);

        $this->assertSame($this->existingView, $response->view);
        $this->assertSame(200, $response->statusCode);
    }

    public function testNotExisitingPathYields404(): void
    {
        $request = $this->createMock(Request::class);
        $request->path = '/path-that-doesnt-exist';

        $response = $this->kernel->handle($request);

        $this->assertNotSame($this->existingView, $response->view);
        $this->assertSame(404, $response->statusCode);
    }
}
