<?php

namespace DevelopersNL\Kernel;

use DevelopersNL\Request\Request;
use DevelopersNL\Request\Route;
use DevelopersNL\Response\ContentResponse;
use DevelopersNL\Response\ResponseInterface;
use DevelopersNL\View\DefaultHtmlView;

class Kernel
{
    /**
     * @param Route[] $routes
     */
    public function __construct(
        private array $routes
    )
    {
    }

    public function handle(Request $request): ResponseInterface
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request)) {
                $result = $route->control($request);
                return $result instanceof ResponseInterface ? $result : new ContentResponse($result, 200);
            }
        }

        return new ContentResponse(new DefaultHtmlView('templates/404.phtml'), 404);
    }
}
