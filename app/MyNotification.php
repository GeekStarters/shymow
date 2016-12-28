<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MyNotification extends Model {

	protected $fillable = ['sender','reseiver','type'];


	public function scopeTypeNotifications($query,$type){
		return $query->whereType($type);
	}
}
