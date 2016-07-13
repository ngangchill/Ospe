<?php namespace Model;

/**
 * Description of Test
 *
 * @author forhad
 */
use \Illuminate\Database\Eloquent\Model;
use Forhad\Eloquent\Rememberable\Rememberable;

class Category extends Model {
	use Rememberable;
    public $timestamps = false;
    
    public function posts()
    {
        return $this->hasMany('Model\Post');
    }

    public function getCatName()
    {
     return $this->categoryTitle;
 }
    /**
     * Scope a query to only include a given category.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCat($query, $categoryName)
    {
        return $query->where('categorySlug', $categoryName);
    }
}

/*
//     public function posts()
//     {
//         return $this->hasMany('Model\Post')
//         ->selectRaw('category_id, count(*) as aggragate')
//         ->groupBy('category_id');
//     }

//     public function getPostsAttribute()
//     {
//   // if relation is not loaded already, let's do it first
//       if ( ! array_key_exists('posts', $this->relations)) 
//         $this->load('posts');

//     $related = $this->getRelation('posts');

//   // then return the count directly
//     return ($related) ? (int) $related->aggragate : 0;
// }
    // return category name 
 */
