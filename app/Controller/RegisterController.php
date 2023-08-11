<?php

namespace DevelopersNL\Controller;

use DevelopersNL\Request\Request;
use DevelopersNL\Response\RedirectResponse;
use DevelopersNL\Response\ResponseInterface;

class RegisterController
{
    public function call(Request $request): ResponseInterface
    {
        // TODO: Implement!
        return new RedirectResponse('/', 303);
    }
}
