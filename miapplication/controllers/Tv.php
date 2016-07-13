<?php 
/**
* Tv
*/
class Tv extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

	}

	function index()
	{
		$this->load->view('tv/index');
	}
}