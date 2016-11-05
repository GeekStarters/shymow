<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Perfil;
use Auth;
use Authenticatable;
use Hash;
use Session;

class AuthenticationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index(Request $request)
	{
		
		$user = [
    		'email' => $request->input('email'),
    		'password' => $request->input('password'),
    		'active' => true
		];
		$v = Validator::make($user, [
			'email' => 'email|required|exists:perfils',
			'password' => 'required|min:8',
	    ]);

	    if ($v->fails())
	    {	
	        return redirect('/')->withErrors($v, 'login');
	    }

	    $remember = false;
    	if ($request->input('remember') == "true") {
    		$remember = true;
    	}

	    if (Auth::attempt($user,$remember))
		{	
	        return redirect()->intended('favoritos');
		}else
		{
			return redirect()->intended('/');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
