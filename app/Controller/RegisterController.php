<?php

namespace DevelopersNL\Controller;

use DevelopersNL\Request\Request;
use DevelopersNL\Response\ViewInterface;

class RegisterController
{
    public function call(Request $request): ViewInterface
    {
        // TODO: Implement!
        var_dump($request->parsedBody); die;
    }
}
