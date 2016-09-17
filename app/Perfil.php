<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
    

class Perfil extends Model implements AuthenticatableContract {
	use Authenticatable;
	protected $table = 'perfils';

	protected $fillable = ['name', 'email','birthdate','genero','pais','provincia','municipio','hobbies','redes','streamings','webs','blogs','role','mi_frase','descripcion','active','img_profile','img_portada','edad','password','work','phone'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	 public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

}
