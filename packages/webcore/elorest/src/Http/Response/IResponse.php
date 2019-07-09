<?php

namespace Webcore\Elorest\Http\Response;

interface IResponse
{
    function response($data, $code, $type);
}
