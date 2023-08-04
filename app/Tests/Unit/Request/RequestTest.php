<?php

namespace DevelopersNL\Tests\Unit\Request;

use DevelopersNL\Request\Request;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Request\Request
 */
class RequestTest extends TestCase
{
    public function testCreateTakesPathFromServerSuperGlobal(): void
    {
        $_SERVER['REQUEST_URI'] = (string) mt_rand();

        $this->assertEquals($_SERVER['REQUEST_URI'], Request::create()->path);
    }
}
