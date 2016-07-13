<?php 
use Illuminate\Support\Facades\Facade;

class TwitterCard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App::make('seotools.twitter');
    }
}

