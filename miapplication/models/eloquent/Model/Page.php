<?php namespace Model;

/**
 * Description of Test
 *
 * @author forhad
 */
use \Illuminate\Database\Eloquent\Model;

use Forhad\Eloquent\Rememberable\Rememberable;
use \Forhad\Eloquent\Slugable\Slugable;

class Page extends Model {

	use Rememberable, Slugable;
    public $timestamps = TRUE;

    public $rules = array(
		'parent_id' => array(
			'field' => 'parent_id', 
			'label' => 'Parent', 
			'rules' => 'trim|intval'
		), 
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]'
		), 
		// 'slug' => array(
		// 	'field' => 'slug', 
		// 	'label' => 'Slug', 
		// 	'rules' => 'trim|required|max_length[100]|url_title'
		// ), 
		'body' => array(
			'field' => 'body', 
			'label' => 'Body', 
			'rules' => 'trim|required'
		)
	);
	// set make slug from 
    public function makeSlugFrom()
    {
    	return 'title';
    }
    public static function get_nested()
	{
		$pages = self::orderBy('order')->get()->toArray();
		//dump($pages);
		$array = array();
		foreach ($pages as $page) {
			if (! $page['parent_id']) {
				// This page has no parent
				$array[$page['id']] = $page;
			}
			else {
				// This is a child page
				$array[$page['parent_id']]['children'][] = $page;
			}
		}
		//dd($array);
		return $array;
	}

	public static function get_new ()
	{
		$page = new \stdClass();
		$page->title = '';
		$page->slug = '';
		$page->body = '';
		$page->parent_id = 0;
		return $page;
	}

	public static function get_with_parent ()
	{
		return self::from( 'pages as p' )
		    ->leftjoin( 'pages as pg', \DB::raw( 'pg.id' ), '=', \DB::raw( 'p.parent_id' ) )
		    ->select( \DB::raw( 'p.*' ),\DB::raw('pg.slug as parent_slug, pg.title as parent_title') )
		    ->get()->toArray();
		// ci()->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
		// ci()->db->from('pages');
		// ci()->db->join('pages as p', 'pages.parent_id=p.id', 'left');
		// return ci()->db->get()->result();
	}
	// depricated
	public static function get_no_parents ()
	{
		$array = ['0' => 'No parent'] + self::where('parent_id' ,'=', '0')->lists('title', 'id')->all();
		
		return $array;
	}

	public static function save_order ($pages)
	{
		if (count($pages)) {
			
			foreach ($pages as $order => $page) {
				if ($page['item_id'] != '') {
					// $pageUpdate = self::find($page['item_id']);
					// dd($pageUpdate);
					// $pageUpdate->parent_id = (int) $page['parent_id'];
					// $pageUpdate->order = $order;
					// $pageUpdate->save();
					self::where('id', $page['item_id'])
						->update([
							'parent_id' => (int) $page['parent_id'],
							'order' => $order
							]); 
					
				}
			}
		}
	}

	public static function deletePage($id)
	{
		//delete the page with given id
		try {
				self::destroy($id);
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException  $e) {
				//show_error($message, $status_code, $heading = 'An Error Was Encountered')
				return show_error('page could not be found.', '404','An Error Was Encountered');
			}
		// reset parent_id to 0 for given id
		self::where('parent_id', $id)->update(['parent_id' => 0]); 
	}
	public static function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = ci()->input->post($field);
		}
		return $data;
	}

	public static function pps()
	{
		return $this->belongsToMany('Models\Page', 'friends', 'friend_id', 'user_id');
	}
}
