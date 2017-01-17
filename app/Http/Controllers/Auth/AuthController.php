<?php namespace App\Http\Controllers\Auth;


use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
//Add These three required namespace

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Perfil;
use App\Social;
use App\Countrie;
use Uuid;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	 public function redirectToProvider($provider)
    {	
        
        if ($provider == 'facebook') {
            return Socialite::driver($provider)->fields([
                'first_name', 'last_name', 'email', 'gender', 'birthday'
            ])->scopes([
                'email', 'user_birthday'
            ])->redirect();
        }elseif($provider == 'google'){
            return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/plus.profile.emails.read'])->redirect();
        }elseif($provider == 'twitter'){
            return Socialite::driver($provider)->redirect();
        }else{
            $countries = Countrie::lists('name','id');
            return redirect('/');
        }
    }
    
     public function handleProviderCallback($provider)
	{
	       
        if($provider == 'facebook'){
            $user = Socialite::driver($provider)->fields([
                'first_name', 'last_name', 'email', 'gender', 'birthday'
            ])->user();
        }else{
            $user = Socialite::driver($provider)->user();
        }
        
       	$socialUser = null;

        $userCheck = Perfil::where('email', '=', $user->email)->first();
        if(!empty($userCheck))
        {
            $socialUser = $userCheck;
        }
        else
        {
            $sameSocialId = Social::where('social_id', '=', $user->id)->where('provider', '=', $provider )->first();

            if(empty($sameSocialId))
            {
            	
                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new Perfil;
                $newSocialUser->email    = $user->email;
                $newSocialUser->name = $user->name;
                $newSocialUser->identification = Uuid::generate(4);
                $newSocialUser->confirmed = true;
                if ($provider == 'google') {
                    $newSocialUser->edad = $user->user['ageRange']['min'];
                    $genero = substr($user->user['gender'], 0,1);
                    $newSocialUser->genero = $genero;
                }
                if ($provider == 'facebook') {
                    if($user->name == null){
                        $newSocialUser->name = $user->user['first_name'].' '.$user->user['last_name'];
                    }
                    $date = date('Y-m-d', strtotime($user->user['birthday']));
                    $fecha = time() - strtotime($date);
                    $edad = (int) floor($fecha / 31556926);
                    $genero = substr($user->user['gender'], 0,1);
                    $newSocialUser->genero = $genero;
                    $newSocialUser->fecha_nacimiento = $date;
                    $newSocialUser->edad = $edad;
                }
                $newSocialUser->save();

                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider= $provider;
                $socialData->access_token= $user->token;
                $socialData->profile_id= $newSocialUser->id;
                $socialData->save();

                $notifications = new Notification_setting();
                $notifications->perfil_id = $user->id;
                $notifications->save();
                // Add role
                // $role = Role::whereName('user')->first();
                // $newSocialUser->assignRole($role);

                $socialUser = $newSocialUser;
            }
            else
            {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }

        }
        Auth::login($socialUser, true);

        //after login redirecting to home page
        return redirect('favoritos');
        // return redirect($this->redirectPath());
	}

}
