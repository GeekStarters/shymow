<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Citie extends Model {

	protected $fillable = ['name','state_id'];

	public function scopeCityOfState($query, $id)
    {
        return $query->select('name', 'id')->where('state_id', '=', $id);
    }
    public function scopeGetCity($query, $id)
    {
        return $query->select('name')->where('id', '=', $id);
    }
}
