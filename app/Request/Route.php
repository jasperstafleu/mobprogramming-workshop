<?php

namespace DevelopersNL\Request;

use DevelopersNL\Response\ResponseInterface;
use DevelopersNL\Response\ViewInterface;

class Route
{
    /**
     * @param callable|string $matcher
     * @param callable $controller
     */
    public function __construct(
        protected $matcher,
        protected $controller
    ) {
    }

    public function matches(Request $request): bool
    {
        return is_callable($this->matcher) ? ($this->matcher)($request) : $request->path === $this->matcher;
    }

    public function control(Request $request): ViewInterface|ResponseInterface
    {
        return ($this->controller)($request);
    }
}
