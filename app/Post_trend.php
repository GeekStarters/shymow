<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_trend extends Model {

	protected $fillable = ['post_id','trend_id','active'];
}
