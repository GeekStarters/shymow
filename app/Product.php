<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images_product;
class Product extends Model {

	protected $fillable = ['id','store_id','title','description','price','stock','send_type','garantia','category_product_id','type_product_id','first_spesification_id','last_spesification_id','qualification','like','share','active','comments'];


	public function scopeProductActive($query){
		return $query->select('*')->where('active', '=', true);
	}

	public function scopeProductImage($query,$id){
		return $query->select('*')->leftJoin('images_products', 'images_products.product_id', '=', 'products.id')->where('products.id','=',$id)->where('products.active','=',true)->groupBy('products.id')->orderBy('products.id', 'desc');
	}
	// SELECT * FROM `products` LEFT JOIN images_products on images_products.product_id = products.id  WHERE products.active = true GROUP BY products.id ORDER BY products.id DESC LIMIT 5'
}
