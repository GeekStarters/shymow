<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Perfil;
use Illuminate\Http\Request;

class UsersDatas extends Controller {

	public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            return Redirect('/');
        }

        $user = Perfil::where("confirmation_code",$confirmation_code)->first();
        if ( ! $user)
        {
            return Redirect('/');
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        flash()->overlay('Tu cuenta fue confirmada', "Welcome");

        return Redirect('/');
    }
}
