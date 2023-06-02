<?php

namespace DevelopersNL\Tests\Unit\Response;

use DevelopersNL\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Response\Response
 */
class ResponseTest extends TestCase
{
    protected Response $response;

    public function setUp(): void
    {
        $this->response = new Response();
    }

    public function testSend(): void
    {
        ob_start();
        $this->response->send();
        $content = ob_get_contents();
        ob_end_clean();

        $this->assertSame("Hello world", $content);
    }
}
