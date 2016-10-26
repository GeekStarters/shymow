<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_post extends Model {

	protected $fillable = ['id','post_id','description','like','qualification','share','active','created_at','posts'];

	public function scopeComments($query, $post){
		return $query->select('*')->where('post_id','=',$post);
	}

}
