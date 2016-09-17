<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model {

	protected $fillable = ['sortname','name','id'];

	public function state()
    {
        return $this->hasOne('App\State');
    }

    public function scopeGetCountry($query, $id)
    {
        return $query->select('name')->where('id', '=', $id);
    }
}
