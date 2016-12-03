<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShare extends Model {

	//
	protected $fillable = ['user_id','profil_id','active','new_post_id'];

}
