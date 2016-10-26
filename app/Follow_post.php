<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow_post extends Model {

	protected $fillable = ['id','perfil_id','post_id','active'];

}
