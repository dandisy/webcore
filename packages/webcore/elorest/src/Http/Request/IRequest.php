<?php

namespace Webcore\Elorest\Http\Request;

interface IRequest
{
    /*
    * Get form input
    *
    * @param Http Request Object $request
    * @return Object $request
    */
    function requestAll($request);
    
    /*
    * Get URL parameters
    *
    * @param Http Request Object $request
    * @return Object $request
    */
    function requestParamAll($request);
}
