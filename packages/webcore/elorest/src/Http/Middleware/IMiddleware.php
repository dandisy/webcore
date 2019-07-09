<?php

namespace Webcore\Elorest\Http\Middleware;

interface IMiddleware
{
    function __construct($routeObj);

    function middleware($route, $middleware);
}
