<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Share_post extends Model {

	protected $fillable = ['id','profil_id','post_id','new_profil_id','new_post_id','share','active','description_old_post'];

}
