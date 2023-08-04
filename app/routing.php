<?php

use DevelopersNL\View\DefaultHtmlView;

return [
    '/' => fn() => new DefaultHtmlView('templates/home.phtml', ['title' => 'Home']),
    '/register' => fn() => new DefaultHtmlView('templates/register.phtml', ['title' => 'Registreren']),
];
