<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification_post extends Model {

	protected $fillable = ['id','post_id','profil_id','qualification','active'];

}
