<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Empresa extends Model {

	use Authenticatable;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'empresas';

	protected $fillable = ['user','empresa','alias','dni','actividad_comercial','empresa_pais','empresa_provincia','empresa_municipio','responsable','email_responsable'];

}
