<?php

namespace DevelopersNL\Response;

use DevelopersNL\View\ViewInterface;

readonly class Response
{
    public function __construct(
        public ViewInterface $view,
        public int $statusCode = 200
    ) {

    }

    public function send(): void
    {
        $content = (string) $this->view;

        http_response_code(empty($content) && $this->statusCode === 200 ? 204 : $this->statusCode);
        echo $content;
    }
}
