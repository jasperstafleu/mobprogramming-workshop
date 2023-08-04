<?php

namespace DevelopersNL\Kernel;

use DevelopersNL\Request\Request;
use DevelopersNL\Response\Response;
use DevelopersNL\View\DefaultHtmlView;

class Kernel
{
    private array $routes;

    public function __construct()
    {
        // TODO: Move to config somewhere.
        $this->routes = [
            '/' => fn() => new DefaultHtmlView('templates/home.phtml', ['title' => 'Home']),
        ];
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
