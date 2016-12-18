<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentProduct extends Model {

	protected $fillable = ['id','product_id','description','like','qualification','share','active','created_at','posts','profil_id'];
	public function scopeComments($query, $post){
		return $query->select('*')->where('product_id','=',$post);
	}
}
