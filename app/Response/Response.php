<?php

namespace DevelopersNL\Response;

use DevelopersNL\View\ViewInterface;

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
