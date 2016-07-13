<?php

namespace Model;

/**
 * Description of Post
 * 
 *
 * @author forhad
 */
use \Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Cartalyst\Tags\TaggableTrait;
use Cartalyst\Tags\TaggableInterface;
use KDuma\Eloquent\Slugabble;
use Forhad\Eloquent\Rememberable\Rememberable;
use Forhad\Eloquent\Pagination\PaginationTrait;


class Post extends Model implements TaggableInterface {
	use TaggableTrait, Slugabble, Rememberable, PaginationTrait;

    protected $fillable = ['category_id','user_id','postTitle','postExcerpt','uri','postContent', 'postContentHtml','published_at'];

    public $timestamps = TRUE;

    public function user() {
        return $this->belongsTo('Model\User');
    }

    public function category() {
      return $this->belongsTo('Model\Category');
    }

    public function getName()
    {
        return $this->postTitle;
    }

    public static function getByDate($year,$month = NULL)
    {
        $query = self::whereYear('created_at', '=', $year);
        if($month)
        {
            $query->whereMonth('created_at', '=', $month);
        }

        return $query;
    }   
    /**
     * Get a post by url
     * @param  numeric $year  2016
     * @param  numeric $month 02
     * @param  mixed $slug  alfaNumericDash
     * @return array or 404 error
     */
    public static function getByUrl($year,$month, $slug)
    {
    	$query = self::whereYear('created_at', '=', $year)
                  ->whereMonth('created_at', '=', $month)
                  ->where('slug', $slug)
                  ->get();
        if (count($query) == 0)
        {
           return show_404();
        } 

        return $query;
    }

    public static function getByCategory($category)
    {
     $query = self::where('cat', $category);
    }
}
