<?php namespace Model;

/**
 * Description of User
 *
 * @author forhad
 */
use \Illuminate\Database\Eloquent\Model;

class User extends Model {
  
    public $timestamps = TRUE;
    
    public function getName()
	{
		if($this->first_name && $this->last_name){
			return "{$this->first_name} {$this->last_name}";
		}
		if($this->first_name){
			return $this->first_name;
		}
		return null;
	}

	
    
    public function posts()
    {
        return $this->hasMany('Model\Post');// foreign key post_id.
    }
}
