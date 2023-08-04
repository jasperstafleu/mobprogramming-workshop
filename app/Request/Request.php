<?php

namespace DevelopersNL\Request;

class Request
{
    public function __construct(
        public string $path,
        public string $method,
        public array $parsedBody
    ) {
    }

    static public function create(): self
    {
        return new self(
            path: $_SERVER['REQUEST_URI'] ?? '',
            method: $_SERVER['REQUEST_METHOD'] ?? '',
            parsedBody: $_POST
        );
    }
}
