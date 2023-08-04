<?php

use DevelopersNL\Controller\RegisterController;
use DevelopersNL\Request\Request;
use DevelopersNL\Request\Route;
use DevelopersNL\View\DefaultHtmlView;

return [
    new Route(
        matcher: '/',
        controller: fn() => new DefaultHtmlView('templates/home.phtml', ['title' => 'Home'])
    ),
    new Route(
        matcher: fn(Request $request) => $request->path === '/register' && $request->method === 'GET',
        controller: fn() => new DefaultHtmlView('templates/register.phtml', ['title' => 'Registreren']),
    ),
    new Route(
        matcher: fn(Request $request) => $request->path === '/register' && $request->method === 'POST',
        controller: fn(Request $request) => (new RegisterController())->call($request),
    ),
];
