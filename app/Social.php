<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Social extends Model {

	use Authenticatable;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'socials';
	
	public function user()
	{
	    return $this->belongsTo('App\User');
	}
}
