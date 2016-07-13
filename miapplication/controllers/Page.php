<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// need for install
// use Illuminate\Database\Capsule\Manager as Capsule;
// use Illuminate\Database\Schema\Blueprint;
 
// page model
use Model\Page as PageM;

class Page extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		//$this->_Instal();
		SEO::setTitle('Page');
		SEO::setDescription('This is my default page description');
		//get laravel cache
		$cache = App::make('laravel.cache');
		$cache->flush();
		$this->data['pages'] = $cache->remember('pages',2, function(){
			return PageM::get_with_parent();
		});
		//$this->data['nav'] = PageM::get_nested();
        // let show
		$this->show();
	}

	public function edit($id = null)
	{
		// Fetch a page or set a new one
		if ($id) {
			try {
				$this->data['page'] = PageM::findOrfail($id);
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException  $e) {
				//show_error($message, $status_code, $heading = 'An Error Was Encountered')
				return show_error('page could not be found.', '404','An Error Was Encountered');
			} 
		}
		else {
			$this->data['page'] =PageM::get_new();
		}
		
		// Pages for dropdown
		// $categories = ['0' => 'No parent'] + PageM::where('parent_id' ,'=', '0')->lists('title', 'id')->all();
		$this->data['pages_no_parents'] = PageM::get_no_parents();
		
		//
		$this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

		// Set up the form
		$pg =  new PageM;
		$rules = $pg->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = PageM::array_from_post(array(
				'parent_id',
				'title', 
				'slug', 
				'body'
			));
			/// update ?
			if($id){ // it is an update request
				PageM::where('id', $id)->update($data); 
			} else { // insert
				$page = new PageM;
				$page->parent_id = $this->input->post('parent_id');
				$page->title = ucfirst($this->input->post('title'));
				$page->body = $this->input->post('body');
				$page->save();
			}
			redirect('page');
		}
		
		// Load the view
		SEO::setTitle('Edit');
		$this->show();
		
	}	

	public function delete($id)
	{
		PageM::deletePage($id);
		redirect('page','refresh');
	}
	public function order()
	{
		$this->data['sortable'] = TRUE;

		SEO::setTitle('Order Pages');
		SEO::setDescription('This is my default page description');
		$this->show();
	}

	public function order_ajax ()
	{
		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			PageM::save_order($_POST['sortable']);
		}
		
		// Fetch all pages
		$this->data['pages'] = PageM::get_nested();

		//dd($this->data['pages']);
		
		// Load view
		$this->load->view('page/order_ajax', $this->data);
	}

	public function _Instal()
	{
		echo "Prepearing installing pages....";
		Capsule::schema()->dropIfExists('pages');
		Capsule::schema()->create('pages', function( Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug')->unique();
			$table->text('body')->nullable();
			$table->string('mdPath')->nullable();
			$table->string('template')->nullable();
			$table->integer('parent_id')->nullable();
			$table->integer('order')->nullable();
			$table->enum('nav', ['yes','no'])->default('yes');
			$table->timestamps();
		});
		dd('Installation completed.');

		////$this->_Instal();
// 		$page = new PageM;
		
// 		$page->title = 'about';
// 		$page->order = 6;
// 		$page->slug = 'about';
// 		$page->body = 'about Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
// tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
// quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
// consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
// cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
// proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
// 		$page->nav = 'yes';
// 		$page->save();
	}

	/**
	 * Some pa
	 */
 public function FAQ()
 {
 	
 	SEO::setTitle('Frequently Asked Question');
	SEO::setDescription('This is my default page description');

	$this->show();
 }
 public function aboutUs()
 {
 	SEO::setTitle('Frequently Asked Question');
	SEO::setDescription('This is my default page description');

	$this->show();
 }
 public function contactUs()
 {
 	dd('jkj');
 	SEO::setTitle('Frequently Asked Question');
	SEO::setDescription('This is my default page description');

	$this->show();
 }

}

/* End of file Page.php */
/* Location: ./application/controllers/Page.php */