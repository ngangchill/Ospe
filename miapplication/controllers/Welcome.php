<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use Forhad\Hub\Hub;
use Model\Category;
use Model\Post;
use Model\Test;

class Welcome extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		//$cache = App::make('laravel.cache');
	   $f = \App::make('files');
        $files = $f->allfiles('storage/cache');
        
        foreach ($files as $key => $cachefile){
        	dump($cachefile->size());
        }
        
    }


}
