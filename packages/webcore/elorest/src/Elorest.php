<?php

namespace Webcore\Elorest;

// use Illuminate\Container\Container;
use Webcore\Elorest\Http\Middleware\LaravelMiddleware;
use Webcore\Elorest\Http\Request\LaravelRequest;
use Webcore\Elorest\Http\Response\LaravelResponse;
use Webcore\Elorest\Repository\EloquentRepository;
use Webcore\Elorest\Route\LaravelRoute;
use Webcore\Elorest\Service\LaravelService;

class Elorest
{
    public static function routes(array $middleware = null) {
        self::processRoute($middleware);
    }

    /*
     * Procesing the route object methods and middleware
     *
     * @param Array $middleware
     * @return void
     */
    protected static function processRoute($middleware) {
        $routes = self::getRegisteredRoute();

        if($middleware) {
            if(isset($middleware['only']))
            {
                foreach($middleware['only'] as $route) {
                    if(in_array($route, $routes)) {
                        self::middleware($route, $middleware['middleware']);
                    }
                }

                $except = array_diff($routes, $middleware['only']);
                foreach($except as $route) {
                    // self::$route();
                    self::routeObjInvoke($route);
                }
            } 
            else if(isset($middleware['except'])) 
            {
                $only = array_diff($routes, $middleware['except']);
                foreach($only as $route) {
                    self::middleware($route, $middleware['middleware']);
                }
                foreach($middleware['except'] as $route) {
                    // self::$route();
                    self::routeObjInvoke($route);
                }
            }
            else
            {
                foreach($routes as $route) {
                    self::middleware($route, $middleware['middleware']);
                }
            }
        } else {
            foreach($routes as $route) {
                // self::$route();
                self::routeObjInvoke($route);
            }
        }
    }

    protected static function getRegisteredRoute() {
        return self::routeObject()->getRoute();
    }

    /*
     * Call the route object methods with middleware
     *
     * @param string $route
     * #param Array $middleware
     * @return void
     */
    protected static function middleware($route, $middleware) {
        // return self::middlewareObject()->middleware($route, $middleware);
        self::middlewareObject()->middleware($route, $middleware);
    }

    /*
     * Create route object
     *
     * @return Object Route
     */
    protected static function routeObject() {
        return new LaravelRoute(
            new LaravelRequest(),
            new EloquentRepository(),
            new LaravelResponse(),
            new LaravelService()
        );

        // This make tight coupling with Laravel Framework
        // and must register ElorestServiceProvide to Laravel config/app.php if installed manually
        // // return resolve('Webcore\Elorest\Route\LaravelRoute');
        // return Container::getInstance()->make(LaravelRoute::class);
    }

    /*
     * Wrapper route object with middleware
     *
     * @return Object Route
     */
    protected static function middlewareObject() {
        return new LaravelMiddleware(self::routeObject());

        // This make tight coupling with Laravel Framework
        // and must register ElorestServiceProvide to Laravel config/app.php if installed manually
        // // return Container::getInstance()->make(LaravelMiddleware::class);
        // return resolve('LaravelMiddleware');
    }

    /*
     * Call the route object methods
     *
     * @param string $route
     * @return void
     */
    protected static function routeObjInvoke($route) {
        // return self::routeObject()->$route();        
        self::routeObject()->$route();
    }

    // protected static function get() {
    //     return self::routeObject()->get();
    // }

    // protected static function post() {
    //     return self::routeObject()->post();
    // }

    // protected static function put() {
    //     return self::routeObject()->put();
    // }

    // protected static function patch() {
    //     return self::routeObject()->patch();
    // }

    // protected static function delete() {
    //     return self::routeObject()->delete();
    // }
}
