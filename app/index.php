<?php

require_once 'vendor/autoload.php';

use DevelopersNL\Request\Request;
use DevelopersNL\Kernel\Kernel;

$request = Request::create();
$kernel = new Kernel();
$response = $kernel->handle($request);
$response->send();
