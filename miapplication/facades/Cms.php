<?php 

use Ahir\Facades\Facade;

class Cms extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    { 
        return 'Forhad\Libs\Mdcms';
    }

}