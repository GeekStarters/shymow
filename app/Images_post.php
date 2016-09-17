<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Images_post extends Model {

	protected $fillable = ['name','path','post_id','active'];


	public function post()
    {
        return $this->belongsTo('App\Post');
    }

}
