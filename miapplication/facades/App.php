<?php 

use Ahir\Facades\Facade;

class App extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     */
    public static function getFacadeAccessor() 
    { 
        return 'Forhad\App\App';
    }

}