<?php 

use Illuminate\Support\Facades\Facade;
/**
 * SEOMeta 
 */
class SEOMeta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('seotools.metatags');
    }
}