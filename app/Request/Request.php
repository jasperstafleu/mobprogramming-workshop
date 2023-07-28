<?php

namespace DevelopersNL\Request;

readonly class Request
{
    public function __construct(
        public string $path
    ) {
    }

    static public function create(): self
    {
        return new self(
            $_SERVER['REQUEST_URI']
        );
    }
}
