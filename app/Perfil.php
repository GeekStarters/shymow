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

	public function social() {
		return $this->hasOne('App\Social');
	}

	public function scopeUser($query, $name)
    {
    	if (trim($name) != "") {
    		$query->select('*')->where('name', 'LIKE', '%'.$name.'%');
    	}
    }

    public function scopeType($query, $type)
    {
    	if (trim($type) != "") {
    		if ($type != "all") {
    			$query->select('*')->where('role',$type);
    		}else{
    			$query->select('*');
    		}
    	}
    }
    public function scopeGenero($query, $genero)
    {
    	if (trim($genero) != "") {
    		if ($genero != "all") {
    			$query->select('*')->where('genero',$genero);
    		}else{
    			$query->select('*');
    		}
    	}
    }
    public function scopeEdad($query, $edad)
    {
        if (trim($edad) != "") {
            if ($edad != "all") {
                $query->select('*')->where('edad',$edad);
            }else{
                $query->select('*');
            }
        }
    }
    public function scopePais($query, $pais)
    {
        if (trim($pais) != "") {
            if ($pais != "all") {
                $query->select('*')->where('pais',$pais);
            }else{
                $query->select('*');
            }
        }
    }
    public function scopeProvincia($query, $provincia)
    {
        if (trim($provincia) != "") {
            if ($provincia != "all") {
                $query->select('*')->where('provincia',$provincia);
            }else{
                $query->select('*');
            }
        }
    }
    public function scopeMunicipio($query, $municipio)
    {
        if (trim($municipio) != "") {
            if ($municipio != "all") {
                $query->select('*')->where('municipio',$municipio);
            }else{
                $query->select('*');
            }
        }
    }

    public function scopeHobbie($query, $hobbie)
    {
        if (trim($hobbie) != "") {
            if ($hobbie != "all") {
            	$query->select('*')->where('hobbies', 'LIKE', '%'.$hobbie.'%');
            }else{
	            $query->select('*');
	        }
        }
    }
    public function scopeRedes($query, $social)
    {
        if (trim($social) != "") {
            if ($social != "all") {
            	$query->select('*')->where('redes', 'LIKE', '%'.$social.'%');
            }else{
	            $query->select('*');
	        }
        }
    }
    public function scopeStream($query, $stream)
    {
        if (trim($stream) != "") {
            if ($stream != "all") {
            	$query->select('*')->where('streamings', 'LIKE', '%'.$stream.'%');
            }else{
	            $query->select('*');
	        }
        }
    }

}
