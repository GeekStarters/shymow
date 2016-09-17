<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $fillable = ['description','category_post_id','profil_id','qualification','like','share'];

}
