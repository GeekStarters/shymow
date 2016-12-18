<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeProduct extends Model {

	protected $fillable = ["id","product_id","profil_id","like","active"];

}
