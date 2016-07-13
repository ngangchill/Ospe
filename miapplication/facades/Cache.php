<?php 
use Illuminate\Support\Facades\Facade;
/**
 * Laravel\Cache
 */
class Cache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('laravel.cache');
    }
}

/*
use Ahir\Facades\Facade;

class Cache extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    /*
    public static function getFacadeAccessor() 
    { 
        return 'Forhad\Libs\Cache';
    }

}*/