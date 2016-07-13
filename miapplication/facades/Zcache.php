<?php 

use Illuminate\Support\Facades\Facade;

class Zcache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('zend.cache');
    }
}