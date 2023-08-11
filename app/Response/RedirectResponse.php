<?php

namespace DevelopersNL\Response;

class RedirectResponse implements ResponseInterface
{
    public function __construct(
        public string $path,
        public int $responseCode = 303
    ) {
    }

    public function send(): void
    {
        header('Location: '.$this->path);
        http_response_code($this->responseCode);
    }
}
