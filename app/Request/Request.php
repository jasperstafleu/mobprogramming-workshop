<?php

namespace DevelopersNL\Request;

class Request
{
    static public function create(): self
    {
        return new self;
    }
}
