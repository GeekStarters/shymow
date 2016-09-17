<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model {

	protected $fillable = ['name','post_id','active'];

	public function scopeTrend($query, $trend)
	{
		return $query->where('name','',$trend);
	}

}
