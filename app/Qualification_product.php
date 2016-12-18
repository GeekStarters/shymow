<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification_product extends Model {

	protected $fillable = ['id','product_id','profil_id','qualification','active'];

}
