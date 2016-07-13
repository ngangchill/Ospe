<?php 

use Ahir\Facades\Facade;

class Meta extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    { 
        return 'Forhad\Seo\MetaCollection';
    }

}