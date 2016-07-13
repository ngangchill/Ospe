<?php 


use Illuminate\Support\Facades\Facade;

class OpenGraph extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('seotools.opengraph');
    }
}


/*

use Ahir\Facades\Facade;

class OpenGraph extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     
    public static function getFacadeAccessor() 
    { 
    	//$og = \App::make('seotools.opengraph');
        return 'Forhad\MySeo\Facades\OpenGraph';
    }

}*/
