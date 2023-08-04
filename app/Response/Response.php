<?php

namespace DevelopersNL\Response;

class Response
{
    public function __construct(
        public ViewInterface $view,
        public int $statusCode = 200
    ) {

    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        echo $this->view;
    }
}
