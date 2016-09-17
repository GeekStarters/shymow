<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model {

	protected $table = 'interests';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','id','categories_id'];

}
