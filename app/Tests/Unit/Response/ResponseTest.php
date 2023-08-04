<?php

namespace DevelopersNL\Tests\Unit\Response;

use DevelopersNL\Response\Response;
use DevelopersNL\View\DefaultHtmlView;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Response\Response
 */
class ResponseTest extends TestCase
{
    protected MockObject|DefaultHtmlView $view;
    protected int $statusCode;
    protected Response $response;

    public function setUp(): void
    {
        $this->view = $this->createMock(DefaultHtmlView::class);
        $this->statusCode = mt_rand();
        $this->response = new Response(
            $this->view,
            $this->statusCode
        );
    }

    protected function getSentContent()
    {
        ob_start();
        $this->response->send();
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function testSendsStringValueOfViewAndRespectsStatusCode(): void
    {
        $expectedContent = (string) mt_rand();

        $this->view->method("__toString")->willReturn($expectedContent);

        $this->assertEquals($expectedContent, $this->getSentContent());
        $this->assertEquals($this->statusCode, http_response_code());
    }
}
