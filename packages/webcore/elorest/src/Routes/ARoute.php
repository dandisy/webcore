<?php

namespace Webcore\Elorest\Route;

use Webcore\Elorest\Http\Request\IRequest;
use Webcore\Elorest\Http\Response\IResponse;
use Webcore\Elorest\Repository\IRepository;
use Webcore\Elorest\Service\AService;

abstract class ARoute
{
    protected $requestObj;
    protected $repositoryObj;
    protected $responseObj;
    protected $serviceObj; 

    protected $routes = [
        'get',
        'post',
        'put',
        'patch',
        'delete'
    ];

    public function __construct(IRequest $requestObj, IRepository $repositoryObj, IResponse $responseObj, AService $serviceObj)
    {
        $this->requestObj = $requestObj;
        $this->repositoryObj = $repositoryObj;
        $this->responseObj = $responseObj;
        $this->serviceObj = $serviceObj;
    }

    public function register($routes) {
        if(is_array($routes)) {
            array_merge(self::$routes, $routes);
        } else {
            array_push(self::$routes, $routes);
        }
    }

    public function getRoute() {
        return $this->routes;
    }

    /*
     * Define how the framework get url segments and http requests for get http method
     *
     * @return Object Route
     */
    abstract public function get();
    
    /*
     * Define how the framework get url segments and http requests for post http method
     *
     * @return Object Route
     */
    abstract public function post();

    /*
     * Define how the framework get url segments and http requests for put http method
     *
     * @return Object Route
     */
    abstract public function put();

    /*
     * Define how the framework get url segments and http requests for patch http method
     *
     * @return Object Route
     */
    abstract public function patch();

    /*
     * Define how the framework get url segments and http requests for delete http method
     *
     * @return Object Route
     */
    abstract public function delete();

    abstract protected function getProcess($request, $namespaceOrModel, $idOrModel, $id);

    abstract protected function postProcess($request, $namespaceOrModel, $model);

    abstract protected function putProcess($request, $namespaceOrModel, $idOrModel, $id);

    abstract protected function patchProcess($request, $namespaceOrModel, $idOrModel, $id);

    abstract protected function deleteProcess($request, $namespaceOrModel, $idOrModel, $id);
}
