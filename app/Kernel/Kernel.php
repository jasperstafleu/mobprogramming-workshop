<?php

namespace DevelopersNL\Kernel;

use DevelopersNL\Request\Request;
use DevelopersNL\Request\Route;
use DevelopersNL\Response\Response;
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

    public function handle(Request $request): Response
    {
        foreach ($this->routes as $route) {
            if ($route->matches($request)) {
                $result = $route->control($request);
                return $result instanceof Response ? $result : new Response($result, 200);
            }
        }

        return new Response(new DefaultHtmlView('templates/404.phtml'), 404);
    }
}
