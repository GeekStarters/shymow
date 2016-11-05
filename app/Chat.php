<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {

	protected $fillable = ['id','userOne','channel','userTwo','name','active'];

	public function scopeChannels($query,$user){
		return $query->select('id','channel')
					->where('userOne',$user)
					->orWhere('userTwo',$user)
					->groupBy('id');
	}
}
