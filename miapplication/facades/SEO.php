<?php 



use Illuminate\Support\Facades\Facade;

class SEO extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('seotools');
    }
}


/*
use Ahir\Facades\Facade;

class SEO extends Facade {

    /**
     * Get the connector name of main class
     *
     * @return string
     *
    public static function getFacadeAccessor() 
    { 
        //$og = \App::make('seotools.opengraph');
        return 'Forhad\MySeo\Facades\SEOTools';
    }

}
 */
