<?php 
use Illuminate\Database\Capsule\Manager as Capsule;

use Illuminate\Database\Schema\Blueprint;
use Model\Post;
use Model\Category;

use Illuminate\Container\Container;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;

use Forhad\Acl\Roles;

class Install extends MY_Controller
{
	public $article;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index(){
		$roles = DB::table('groups')
			->leftjoin('groups as r','groups.id', '=', 'r.parent_id')
			->select('groups.*', 'r.id as rid','r.name as parent_name', 'r.parent_id as parent')
			->get();
		dump(DB::getQueryLog());
		dd($roles);
		dd(Roles::get_roles());
		// //$this->acl();	
		// $total_rows = Post::doPaginate(2)->get()->toArray();
		
		// dd($total_rows);
	}
		// $dd = Post::paginate($total_rows)->get()->toArray();
		// echo "<pre>";
		// echo $this->pagination->create_links();
		// echo "</pre>";
		// //dump($this->pagination->create_links());
		// dd($dd);

		// $c = $container['cache'];
		// $c->put('cc', 'sanam re', 3);
		//dd(App::make('cache'));
		//$c = App::make('filesystem');
		
		//$data = $c->get('Tag.md'); 
		/*
		dd(Storage::disk('local')->allFiles('zfcache'));
		die;

		$cache = App::make('cache');
		$cache->put('test', 'This is loaded from cache.', 500);

    // Echo out the value we just stored in cache
    echo $cache->get('test');die;
		dd($cache);
*/
		
		// $zfc =  App::make('zCache');
		// $zfc->save('faisal', 'fsl', ['names']);
		// $zfc->save('jewel', 'jwl', ['names']);
		// $zfc->save('ishak', 'isk', ['names']);
		// //
		// //$zfc->clean();// all clean
		// //$zfc->clean(Zend_Cache::CLEANING_MODE_OLD); // delete expired cache
		// //$zfc->clean(Zend_Cache::CLEANING_MODE_MATCHING_ANY_TAG,['tag']); // any tag
		// // clean all records
		// //$cache­>clean(Zend_Cache::CLEANING_MODE_ALL);
		// //
		// dump('load',$zfc->load('name'));
		// echo '<hr>';
		// dump('load',$zfc->load('faisal'));
		// echo '<hr>';
		// dump('load',$zfc->load('jewel'));
		// echo '<hr>';
		// dump('test',$zfc->test('name'));
		// echo '<hr>';
		// dump('all ids',$zfc->getIds());
		// echo '<hr>';
		// //Return an array of stored tags 
		// dump('all tags',$zfc->getTags());echo '<hr>';
		// dump('all %',$zfc->getFillingPercentage());echo '<hr>';
		// dump('metadata',$zfc->getMetadatas('name'));echo '<hr>';
		// dump('increase lifetime',$zfc->touch('name', 1));
		// die;
		
		// //$zfc->save('forhad', 'name', ['myName']);
		// dump($zfc->load('name'));
		// //Return an array of stored cache ids
		// dump($zfc->getIds());
		// //Return an array of stored tags 
		// dump($zfc->getTags());
		// *
  //    * Return the filling percentage of the backend storage
  //    *
  //    * @return int integer between 0 and 100
     
		// dump($zfc->getFillingPercentage());

		// /**
  //    * Return an array of metadatas for the given cache id
  //    *
  //    * The array will include these keys :
  //    * - expire : the expire timestamp
  //    * - tags : a string array of tags
  //    * - mtime : timestamp of last modification time
  //    *
  //    * @param string $id cache id
  //    * @return array array of metadatas (false if the cache id is not found)
  //    */
  //   dump($zfc->getMetadatas('name'));
  //   /**
  //    * Give (if possible) an extra lifetime to the given cache id
  //    *
  //    * @param string $id cache id
  //    * @param int $extraLifetime
  //    * @return boolean true if ok
  //    */
  //   dump($zfc->touch('name', 180));
		// die;
		
		// SEO::setTitle('Home');
  //       SEO::setDescription('This is my page description');
  //       SEO::opengraph()->setUrl('http://current.url.com');
  //       SEO::opengraph()->addProperty('type', 'articles');
  //       SEO::twitter()->setSite('@LuizVinicius73');

		// dd(SEO::generate());
		// die;
		// $cache = App::make('seotools');
		// //$cache->setTitle('Home');
		// SEOMeta::setTitle('pingpong');
		// OpenGraph::setDescription('This is my page description');
		// OpenGraph::setUrl('http://current.url.com');
		// dump($cache->generate());
		
		//dd(Post::paginate(1));
		//$this->data['posts'] = Post::paginate(1);
		//$this->show();
		// $file = App::make('files');


		// $trevor = App::make('trevor');

		// //dd($trevor->toJson('<div>sads</div>'));
		
		// $view = App::make('view');
		// echo $view->make('welcome.test');

		//$file = App::make('files');
		//dd($file->allfiles('content'));
		//$cache->put('bar', 'baz', 1);

		//dump($cache->get('bar'));




		// $this->load->library('migration');

		// if ($this->migration->current() === FALSE)
		// {
		// 	show_error($this->migration->error_string());
		// }
		//$this->user();
		//$this->insertPost();
		//Capsule::schema()->dropIfExists('categories');
		//Capsule::schema()->dropIfExists('posts');
		//$this->blog();
		///$this->categories();
		//$this->insertCat();
	//}

	function acl()
	{
		Capsule::schema()->create('resources', function( Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', ['controller','function']);
			$table->string('resource_controller')->nullable();
			$table->string('resource_function')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
		});
		Capsule::schema()->create('rules', function( Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned();
			$table->enum('type', ['allow','deny']);//->default('allow');
			$table->string('resource_controller')->nullable();
			$table->string('resource_function')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
			$table->foreign('role_id')
				  ->references('id')
				  ->on('groups');
		});


		// Capsule::schema()->create('blogs', function( Blueprint $table)
		// {
		// 	$table->increments('id');
		// }
		// Capsule::schema()->create('blogs', function( Blueprint $table)
		// {
		// 	$table->increments('id');
		// }
	}

	public function blog(){
		Capsule::schema()->create('blogs', function( Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('title');
			$table->string('excerpt')->nullable();
			$table->string('keywards')->nullable();
			$table->string('slug')->unique();
			$table->text('content')->nullable();
			$table->text('htmlcontent')->nullable();
			$table->string('image')->nullable();
			$table->enum('status', [1,0])->default(1);
			$table->timestamps();
			$table->softDeletes();
			$table->timestamp('published_at');

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->foreign('category_id')
				->references('id')
				->on('categories');
		});
	}
	public function blogs(){
		Capsule::schema()->create('posts', function( Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('postTitle');
			$table->string('postExcerpt')->nullable();
			//$table->string('slug',100)->nullable();
			$table->string('slug')->unique();
			$table->text('postContent')->nullable();
			$table->text('postContentHtml')->nullable();
			$table->string('postImage')->nullable();
			$table->enum('postStatus', [1,0])->default(1);
			$table->timestamps();
			$table->timestamp('published_at');

			$table->foreign('user_id')
			->references('id')
			->on('users')
			->onDelete('cascade');
			$table->foreign('category_id')
			->references('id')
			->on('categories');
		});
	}

	public function categories(){
		Capsule::schema()->create('categories', function( Blueprint $table)
		{
			$table->increments('id');
			$table->string('categoryTitle');
			$table->string('categorySlug')->nullable();
			$table->string('categoryDescription')->nullable();
            //$table->enum('cat_type', ['blog','forum'])->default('blog');
		});
	}

	public function user()
	{
		// Table User
		Capsule::schema()->create('users', function(Blueprint $table){
			$table->increments('id')->unsigned();
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('ip_address',16);
			$table->string('username', 100);
			$table->string('password',80);
			$table->string('salt',40);
			$table->string('email',100);
			$table->string('activation_code', 40);//->nullable();
			$table->string('forgotten_password_code', 40);//->nullable();
			$table->integer('forgotten_password_time', 11);//->nullable();
			$table->string('remember_code', 40);//->nullable();
			$table->timestamps();
			$table->integer('last_login',11);//->unsigned()->nullable();
			$table->tinyInteger('active',1);//->unsigned()->nullable();
			$table->string('company',100)->nullable();
			$table->string('phone',100)->nullable();
		});

		// Table groups
		Capsule::schema()->create('groups', function(Blueprint $table){
			$table->increments('id')->unsigned();
			$table->string('name', 20);
			$table->string('description', 100);
		});
		// Table User_groups
		Capsule::schema()->create('users_groups', function(Blueprint $table){
			$table->increments('id')->unsigned();
			$table->mediumInteger('user_id', 8)->unsigned();
			$table->mediumInteger('group_id', 8)->unsigned();
		});
		// Table User_groups
		Capsule::schema()->create('login_attempts', function(Blueprint $table){
			$table->increments('id')->unsigned();
			$table->string('ip_address',16);
			$table->string('login',100)->nullable();
			$table->integer('time', 11)->unsigned()->nullable();
		});
	}

	public function tags()
	{
		Capsule::Schema()->create('tagged', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taggable_type');
            $table->integer('taggable_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->engine = 'InnoDB';

            $table->index([ 'taggable_type', 'taggable_id' ]);
        });

        Capsule::Schema()->create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namespace');
            $table->string('slug');
            $table->string('name');
            $table->integer('count')->default(0)->unsigned();

            $table->engine = 'InnoDB';
        });
	}

	/**
	 * insert demo post
	 */
	public function insertPost(){
	}

	public function article()
	{
		Capsule::Schema()->create('articles', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title', 255);
            $table->text('content');
            $table->string('slug')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('excerpt')->nullable();
            $table->boolean('is_published')->default(true);
            $table->string('path', 255)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->integer('file_size')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->foreign('category_id')
				->references('id')
				->on('categories');
        });
	}


// 		$post = new Post;

// 		$post->category_id = 1;
// 		$post->user_id = 1;
// 		$post->postTitle = "foobar bibendum quam";
// 		$post->postExcerpt = "Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque.";
// 		$post->uri = "consequat-bibendum-quam";
// 		$post->postContent = "Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.

// Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a adipiscing sapien. Suspendisse vehicula porta lectus vel semper.";
// 		$post->postContentHtml = "";

// 		$post->published_at = '2016/02/06';

// 		$post->save();
// 		
// 		Faker...
 // 		$faker = Faker\Factory::create();
	// 	foreach(range(1,4) as $i){
	// 		Post::create([
	// 			'category_id' => 1,
	// 			'user_id' => 1,
	// 			'postTitle' => $faker->sentence,
	// 			'postExcerpt' => $faker->paragraph(2),
	// 			'uri' => $faker->url(),
	// 			'postContent' => $faker->paragraph(10),
	// 			'postContentHtml' => $faker->paragraph(10),
	// 			'published_at' => Carbon\Carbon::now()	
	// 		]);
	// 	}


	// }
	
	// public function insertCat(){
	// 	$cat = new Category;
	// 	$cat->categoryTitle  = 'surgery';
	// 	$cat->categorySlug  = 'surgery';
	// 	$cat->categoryDescription  = 'surgery ospe';
	// 	$cat->save();
	// }
}