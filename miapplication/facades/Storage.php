<?php 
use Illuminate\Support\Facades\Facade;
/**
 * Laravel\Cache
 */
class Storage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('filesystem');
    }
}