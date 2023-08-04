<?php

namespace DevelopersNL\Kernel;

use DevelopersNL\Request\Request;
use DevelopersNL\Response\Response;
use DevelopersNL\View\DefaultHtmlView;

class Kernel
{
    public function __construct(
        private array $routes
    )
    {
    }

    public function handle(Request $request): Response
    {
        foreach ($this->routes as $path => $controller) {
            if ($request->path === $path) {
                return new Response($controller($request), 200);
            }
        }

        return new Response(new DefaultHtmlView('templates/404.phtml'), 404);
    }
}
