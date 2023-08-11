<?php

namespace DevelopersNL\Response;

class ContentResponse implements ResponseInterface
{
    public function __construct(
        public ViewInterface $view,
        public int $responseCode = 200
    ) {

    }

    public function send(): void
    {
        http_response_code($this->responseCode);
        echo $this->view;
    }
}
