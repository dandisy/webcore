<?php namespace Infinety\FileManager\Facades;

use Illuminate\Support\Facades\Facade;
use Infinety\FileManager\Services\FileFunctionsService;

class FileFunctionsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new FileFunctionsService();
    }
}