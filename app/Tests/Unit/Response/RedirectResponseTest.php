<?php

namespace DevelopersNL\Tests\Unit\Response;

use DevelopersNL\Response\RedirectResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Response\RedirectResponse
 */
class RedirectResponseTest extends TestCase
{
    public function testSendsCorrectResponseCodeAndPath()
    {
        $responseCode = mt_rand();
        $path = (string) mt_rand();

        $response = new RedirectResponse($path, $responseCode);

        $response->send();

        $this->assertEquals($responseCode, http_response_code());
    }
}
