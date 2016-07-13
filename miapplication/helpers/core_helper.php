<?php
// Read More button for article
function url($date, $slug = null)
{
	// pasre date
	$parsedDate = Carbon\Carbon::parse($date)->format('Y/m');
	return base_url('articles/'.$parsedDate.'/'.$slug);
}

function category()
{
	$str = '<div class="widget categories">';
	$str .= '<h3>Categories</h3>';
	$str .= '<div class="row">';
	$str .= '<div class="col-sm-6">';
	$str .= '<ul class="blog_category">';
	//get categories
	//$categories = Model\Category::all();
	$categories = Cache::remember('categoryForView', 120, function(){
		return Model\Category::all();
	});

	foreach($categories as $cat)
	{
		$str .= '<li><a href="'. base_url(Route::named('category').'/'.$cat->categorySlug).'">'
		.ucfirst($cat->categoryTitle)
		.' <span class="badge">'. $cat->posts()->count().'</span>';
		$str .='</a></li>';
	}
	$str .= '</ul>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</div>';
	return $str;

}
function archieve()
{
	$posts_by_date = Cache::remember('archieveForView', 120, function(){
		return Model\Post::all()->groupBy(function($date) {
			return Carbon\Carbon::parse($date->created_at)->format('F Y');
		});
	});
	//dd($posts_by_date);
	$str = '<div class="widget archieve">';
	$str .= '<h3>Archieve</h3>';
	$str .= '<div class="row">';
	$str .= '<div class="col-sm-12">';
	$str .= '<ul class="blog_archieve">';

	foreach ($posts_by_date as $key => $value) {
		$str .= '<li>';
		$str .= '<a href="'.base_url('articles/'.Carbon\Carbon::parse($key)->format('Y/m')).'">';
		$str .= '<i class="fa fa-angle-double-right"></i> ';
		$str .= $key;
		$str .= '<span class="pull-right">('.count($value).')</span>';
		$str .= '</a>';
		$str .= '</li>';
	}

	$str .= '</ul>';
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</div>';

	return $str;

}
function tagCloud()
{
	$str = '<div class="widget tags">';
	$str .= '<h3>Tag Cloud</h3>';
	$str .= '<ul class="tag-cloud">';
	$allTags = Cache::remember('tagCloud', 3700, function(){
		return DB::table('tags')->lists('slug');
	});
	foreach($allTags as $tag)
	{
		$str .= '<li>';
		$str .= '<a class="btn btn-xs btn-primary" href="'.base_url('articles/tag/'.$tag).'">'.ucfirst($tag).'</a>';
		$str .= '</li>';

	}
	$str .= '</ul>';
	$str .= '</div>';

	return $str;
}
	/**
     * Gravatar URL from Email address
     *
     * @param string $email Email address
     * @param string $size Size in pixels
     * @param string $default Default image [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating Max rating [ g | pg | r | x ]
     *
     * @return string
     */
	function gravatarUrl($email, $size = 60, $default = 'mm', $rating = 'g') {

		return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s={$size}&d={$default}&r={$rating}";
	}

	function ci()
	{
		return get_instance();
	}


	function btn_edit ($uri)
	{
		return anchor($uri, '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
	}

	function btn_delete ($uri)
	{
		return anchor($uri, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array(
			'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
			));
	}


	function get_excerpt($article, $numwords = 50){
		$string = '';
		$url = article_link($article);
		$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
		$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
		return $string;
	}

	function limit_to_numwords($string, $numwords){
		$excerpt = explode(' ', $string, $numwords + 1);
		if (count($excerpt) >= $numwords) {
			array_pop($excerpt);
		}
		$excerpt = implode(' ', $excerpt);
		return $excerpt;
	}

	function ee($string){
		return htmlentities($string);
	}

	function get_menu ($array, $child = FALSE)
	{
		$CI =& get_instance();
		$str = '';

		if (count($array)) {
			$str .= $child == FALSE ? '<ul class="nav navbar-nav pull-right">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

			foreach ($array as $item) {

				$active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
				if (isset($item['children']) && count($item['children'])) {
					$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
					$str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . ee(ucfirst($item['title']));
					$str .= '<b class="caret"></b></a>' . PHP_EOL;
					$str .= get_menu($item['children'], TRUE);
				}
				else {
					$str .= $active ? '<li class="active">' : '<li>';
					$str .= '<a href="' . site_url($item['slug']) . '">' . ee(ucfirst($item['title'])) . '</a>';
				}
				$str .= '</li>' . PHP_EOL;
			}

			$str .= '</ul>' . PHP_EOL;
		}

		return $str;
	}

	function makeTree($directory, $returnLink, $extensions = ['md'])
	{
		$treeView = new \Forhad\Libs\FileTree($directory, $returnLink, $extensions);
		return $treeView->showTree();
	}