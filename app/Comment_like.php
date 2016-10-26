<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_like extends Model {

	protected $fillable = ['post_id','profil_id','like','deslike','active','id'];

}
