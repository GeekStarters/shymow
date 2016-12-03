<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikes extends Model {

	protected $fillable = ['user_id','profil_id','active','like'];

}
