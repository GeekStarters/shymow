<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MyNotificationShop extends Model {

	protected $fillable = ['sender','reseiver','type','read','description','object_id','active'];

}
