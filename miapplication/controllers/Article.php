<?php

/**
* Post Controller
*/
use Carbon\Carbon;
use Model\Category;
use Model\Post;
//use Sioen\Converter;
use Forhad\Trevor\Converter;

class Article extends MY_Controller
{
	protected $limit = 4;

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->output->enable_profiler(TRUE);
	}

	// Paginate Articles
	public function index(){
		SEO::setTitle('Article Home');
		SEO::setDescription('This is my page description');
		SEO::opengraph()->setUrl(base_url('articles'));
		SEO::opengraph()->addProperty('type', 'articles');
		SEO::twitter()->setSite('@LuizVinicius73');
		SEO::opengraph()->setSiteName('ospe.dev');             
		$this->data['posts'] = Post::remember(60)
			->orderBy('created_at', 'desc')
			->doPaginate($this->limit)
			->get();                                       
		$this->data['links'] = $this->pagination->create_links();                                       
		
		$this->show();
	}

	/**
	 * Show new article form
	 * @return [type] [description]
	 */
	public function getArticle(){
		$this->load->helper('form');
		$this->show();
	}
	/**
	 * Process submitted new article
	 * @return [type] [description]
	 */
	public function postArticle(){
		//category_id user_id postTitle postExcerpt uri postContent postContentHtml postImage postStatus published_at
		$post = new Post;
		$post->category_id 	= 1;
		$post->user_id 	   	= 1;
		$post->postTitle   	= $this->input->post('postTitle');
		$post->postExcerpt	= $this->input->post('postExcerpt');
		$post->postContent 	= $this->input->post('content');
		$post->postContentHtml = "";

		$post->published_at = Carbon::now();
		
		$post->save();
		$tags = $this->input->post('tags');
		if($tags) {
			// Latest insert id
			$insertId = $post->id;
			// Get the entity object
			try {
				$setTags = Post::findOrfail($insertId);
				$setTags->setTags($tags);
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException  $e) {
				//show_error($message, $status_code, $heading = 'An Error Was Encountered')
				return show_error('Articles not found.', '404','An Error Was Encountered');
			} 
			
		}
		redirect('articles','refresh');
		
	}

	public function getEdit()
	{
		$this->load->helper('form');
		$id = $this->uri->segment('id');

		try {
			$this->data['post'] = Post::findOrfail($id)->toArray();

			$this->show();

		} catch(Illuminate\Database\Eloquent\ModelNotFoundException  $e) {
			return show_error('Articles not found.', '404','An Error Was Encountered');
		}		
	}

	public function postEdit()
	{
		$id = $this->uri->segment('id');

		try {
			$this->data['post'] = Post::findOrfail($id);

		} catch(Illuminate\Database\Eloquent\ModelNotFoundException  $e) {
			return show_error('Articles not found.', '404','An Error Was Encountered');
		}	

		dd(Post::find($id));
		if($id == $this->input->post('id'))
		{
			return dump($id, $_POST);
		}
		show_404();
	}
	/**
	 * View article based on url
	 * @return array
	 */
	public function view()
	{
		$slug = $this->uri->segment('slug');
		$year = $this->uri->segment('year');
		$month = $this->uri->segment('month');
		// create key for caching
		//$key = 'article_'.$year.'_'.$month.'_'.$slug;
		$this->data['post'] = Post::remember(60)->whereYear('created_at', '=', $year)
			->whereMonth('created_at', '=', $month)
			->where('slug', $slug)
			->first();
		
		// if no post found, return 404 error	
		if (count($this->data['post']) == 0) {
			return show_404();
		} 
		SEO::setTitle(ucfirst($this->data['post']->postTitle));
		SEO::setDescription($this->data['post']->postExcerpt);
		//SEO::metatags()->setKeywords(['fdgf,fgdfg']); // need to  add keywards column in the post table
		SEO::opengraph()->setUrl(url($this->data['post']->created_at,$this->data['post']->slug));
		SEO::opengraph()->addProperty('type', 'articles');
		SEO::opengraph()->setSiteName('ospe.dev');//OpenGraph::setSiteName($name);
		SEO::twitter()->setSite('@forhad0a');

		$this->show();
	}
	
	public function category()
	{
		$catName = $this->uri->segment('categoryName');

		$this->data['cat'] = Category::remember(88)->cat($catName)->first();
		// if no post found, return 404 error	
		if (count($this->data['cat']) == 0) {
			return show_404();
		} 
		$this->data['posts'] = $this->data['cat']->posts()
			->remember(60)
			->orderBy('created_at', 'desc')
			->doPaginate(2)->get();
		$this->data['links'] = $this->pagination->create_links();

		SEO::setTitle(ucfirst($this->data['cat']->categoryTitle));
		SEO::setDescription($this->data['cat']->categoryDescription);
		SEO::opengraph()->setUrl(base_url().Route::named('category'));
		SEO::opengraph()->addProperty('type', 'articles category');
		SEO::opengraph()->setSiteName('ospe.dev');//OpenGraph::setSiteName($name);
		SEO::twitter()->setSite('@forhad0a');

		$this->show();
	}
	// get by year  nd month
	public function getBydate()
	{
		$year = $this->uri->segment('year');
		$month = $this->uri->segment('month');

		$this->data['posts'] = Post::remember(60)
			->whereYear('created_at', '=', $year)
			->whereMonth('created_at', '=', $month)
			->orderBy('created_at', 'desc')
			->doPaginate(2)
			->get();
		$this->data['links'] = $this->pagination->create_links();
		// Archieve Year
		// Archieve Month
		$this->data['year'] = $year;
		$this->data['month'] = $month;

		//
		SEO::setTitle('Archieve :: '.$year.'/'.$month);
		$this->show();
	}

	public function getByTag()
	{
		
		$tag = $this->uri->segment('tag');
		
		$this->data['posts'] = Post::withTag($tag)
			->orderBy('created_at', 'desc')
			->doPaginate($this->limit)
			->get();
		$this->data['links'] = $this->pagination->create_links();
		
		$this->data['tag'] = $tag;


		SEO::setTitle('Tags:: '.ucfirst($tag));
		
		$this->show();
	}

}

	// public function getArchieve()
	// {


	// 	$posts_by_date = Post::all()->groupBy(function($date) {
	// 		return Carbon::parse($date->created_at)->format('F Y');
	// 	});

	// 	foreach ($posts_by_date as $key => $value) {
	// 		echo '<h2>'.$key.' '.count($value) .'</h2>';
	// 		// foreach ($value as $val) {
	// 		// 	//dd($val);
	// 		// 	echo '<h3>'.$val->postTitle.'</h3>';
	// 		// 	//echo '<p>'.$date.'</p>';
	// 		// }
	// 	}

	// 	dd($posts_by_date);



	// 	$titles = DB::table('posts')->lists('postTitle');
	// 	//dd(DB::getQueryLog());

	// 	foreach ($titles as $title) {
	// 		echo $title.'<br>';
	// 	}
	// }