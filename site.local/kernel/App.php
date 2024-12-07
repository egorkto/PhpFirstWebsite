<?php

namespace App\Kernel;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;

class App
{
    public function run()
    {
        $router = new Router;
        $request = Request::createFromGlobals();

        $uri = $request->uri();
        $method = $request->method();
        $router->dispatch($uri, $method);
    }
}
