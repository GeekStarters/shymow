<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model {

	protected $fillable = ['first_name','last_name','profile_id','email_store','phone','address','further_office','store_close','active'];


	public function scopeUserStore($query,$id_user){
		return $query->where('profile_id','=',$id_user);
	}

}
