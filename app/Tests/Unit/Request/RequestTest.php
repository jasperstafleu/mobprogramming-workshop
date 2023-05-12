<?php

namespace DevelopersNL\Tests\Unit\Request;

use DevelopersNL\Request\Request;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Request\Request
 */
class RequestTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(Request::class, Request::create());
    }
}
