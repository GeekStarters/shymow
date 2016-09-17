<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

	protected $fillable = ['name','id'];

	public function citie()
    {
        return $this->hasOne('App\Citie');
    }

    public function scopeStateOfCountry($query, $id)
    {
        return $query->select('name', 'id')->where('countrie_id', '=', $id);
    }

    public function scopeGetState($query, $id)
    {
        return $query->select('name')->where('id', '=', $id);
    }
}
