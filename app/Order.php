<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	//
	protected $fillable = ['id','product_id','address_city','address_country','address_name','address_status','address_street','address_zip','business','first_name','last_name','handling_amount','item_name','mc_currency','payer_email','payer_id','payer_status','payment_date','payment_status','receiver_email','receiver_id','shipping','payment_fee','payment_gross','mc_fee','mc_gross','txn_id','acive'];


	public function scopeMonto($query, $id){
		return $query->select('mc_gross')->where('id', '=',$id);
	}
}
