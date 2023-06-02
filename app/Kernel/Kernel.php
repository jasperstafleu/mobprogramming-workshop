<?php

namespace DevelopersNL\Kernel;

use DevelopersNL\Request\Request;
use DevelopersNL\Response\Response;

class Kernel
{
    public function handle(Request $request): Response
    {
        return new Response();
    }
}
