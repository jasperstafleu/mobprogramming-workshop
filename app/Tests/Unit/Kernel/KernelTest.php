<?php

namespace DevelopersNL\Tests\Unit\Kernel;

use DevelopersNL\Kernel\Kernel;
use DevelopersNL\Request\Request;
use DevelopersNL\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Kernel\Kernel
 */
class KernelTest extends TestCase
{
    protected Kernel $kernel;

    public function setUp(): void
    {
        $this->kernel = new Kernel();
    }

    public function testHandle(): void
    {
        $request = $this->createMock(Request::class);
        $response = $this->kernel->handle($request);

        $this->assertInstanceOf(Response::class, $response);
    }
}
