<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like_post extends Model {

	protected $fillable = ["id","post_id","profil_id","like","active"];

}
