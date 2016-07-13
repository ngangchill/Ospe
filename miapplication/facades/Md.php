<?php 
use Ahir\Facades\Facade;

class Md extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    { 
        return 'Forhad\Trevor\Converter';
    }

}