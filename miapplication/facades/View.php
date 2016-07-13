<?php 
use Illuminate\Support\Facades\Facade;

class View extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('view');
    }
}

// use Ahir\Facades\Facade;

// class View extends Facade {

//     /**
//      * Get the connector name of main class
//      *
//      * @return string
//      */
//     public static function getFacadeAccessor() 
//     { 
//         return 'Forhad\Blade\View';
//     }

// }
