<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class MyNotification extends Model {

	protected $fillable = ['sender','reseiver','type','read','description','object_id','active'];


	public function scopeTypeNotifications($query,$type){
		return $query->where('type','=',$type)->where('reseiver','=',Auth::id())->whereActive('true');
	}
}
