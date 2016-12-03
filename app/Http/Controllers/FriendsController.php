<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Perfil;
use App\Friend;
class FriendsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Al users
		$users = Perfil::where('active',true)->paginate(20);

		//Friends
		$id = Auth::user()->id;
		//Stack users
		$user_contents = [];
		//ID all my friends
		$friends = DB::select('SELECT * FROM friends WHERE (user1 = '.$id.' OR user2 = '.$id.') AND status = 1');
		// dd($friends);
		//If i had more than one friends
		if (count($friends) > 0) {
			// I get each users
			foreach ($friends as $friend) {
				//declare a variable ID user
				$user_id = "";

				//If this user is equal to ID
				if ($friend->user1 == $id)
					//Add value to user_id of another user
					$user_id = $friend->user2;
				else
					//If not add value user_id this user
					$user_id = $friend->user1;

				//let's search a user active
				$user = Perfil::select('id')->where('id',$user_id)
								->where('active',true)
								->first();
				//If return user is more than one and less than two
				if (count($user)>0 && count($user) < 2) {
					array_push($user_contents, $user);
				}
			}
		}


		//Stack users
		$user_pending = [];
		//ID user pending
		$pendings = DB::select('SELECT * FROM friends WHERE (user1 = '.$id.' OR user2 = '.$id.') AND status = 0');
		// dd($pendings);
		//If i had more than one pendings
		if (count($pendings) > 0) {
			// I get each users
			foreach ($pendings as $pending) {
				//declare a variable ID user
				$user_id = "";

				//If this user is equal to ID
				if ($pending->user1 == $id)
					//Add value to user_id of another user
					$user_id = $pending->user2;
				else
					//If not add value user_id this user
					$user_id = $pending->user1;

				//let's search a user active
				$user = Perfil::select('id')->where('id',$user_id)
								->where('active',true)
								->first();
				//If return user is more than one and less than two
				if (count($user)>0 && count($user) < 2) {
					array_push($user_pending, $user);
				}
			}
		}


		//Stack users
		$user_blocked = [];
		//ID user pending
		$blockeds = DB::select('SELECT * FROM friends WHERE (user1 = '.$id.' OR user2 = '.$id.') AND status = 3');
		// dd($blockeds);
		//If i had more than one blockeds
		if (count($blockeds) > 0) {
			// I get each users
			foreach ($blockeds as $blocked) {
				//declare a variable ID user
				$user_id = "";

				//If this user is equal to ID
				if ($blocked->user1 == $id)
					//Add value to user_id of another user
					$user_id = $blocked->user2;
				else
					//If not add value user_id this user
					$user_id = $blocked->user1;

				//let's search a user active
				$user = Perfil::select('id')->where('id',$user_id)
								->where('active',true)
								->first();
				//If return user is more than one and less than two
				if (count($user)>0 && count($user) < 2) {
					array_push($user_blocked, $user);
				}
			}
		}

		//Stack users
		$user_declined = [];
		//ID user pending
		$declineds = DB::select('SELECT * FROM friends WHERE (user1 = '.$id.' OR user2 = '.$id.') AND status = 2');
		// dd($declineds);
		//If i had more than one declineds
		if (count($declineds) > 0) {
			// I get each users
			foreach ($declineds as $declined) {
				//declare a variable ID user
				$user_id = "";

				//If this user is equal to ID
				if ($declined->user1 == $id)
					//Add value to user_id of another user
					$user_id = $declined->user2;
				else
					//If not add value user_id this user
					$user_id = $declined->user1;

				//let's search a user active
				$user = Perfil::select('id')->where('id',$user_id)
								->where('active',true)
								->first();
				//If return user is more than one and less than two
				if (count($user)>0 && count($user) < 2) {
					array_push($user_declined, $user);
				}
			}
		}

		// dd($user_pending);
		return view('logueado.add_users',compact('users','user_blocked','user_contents','user_pending','user_declined'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id = null)
	{
		if ($id != null) {
			$count = Perfil::where('id',$id)->where('active',true)->count();
			if ($count>0) {
				if ($id != Auth::id()) {
					$relation = Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->get();

					if (count($relation)>0) {
						if ($relation[0]->status == 1) {
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>2]);
							flash('Usuario eliminado', 'success');
						}elseif($relation[0]->status == 2){
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>0]);
							flash('Solicitud de amistad enviada', 'success');
						}elseif($relation[0]->status == 0){
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>2]);
							flash('Solicitud de amistad cancelada', 'success');
						}
					}else{
						$newF = new Friend();
							$newF->user1 = Auth::id();
							$newF->user2 = $id;
							$newF->status = 0;
						$newF->save();
						flash('Solicitud de amistad enviada', 'success');
					}
					return redirect('amigos');
				}else{
					flash('Sucedio un error', 'danger');
					return redirect('all_users');
				}
			}else{
				flash('Sucedio un error', 'danger');
				return redirect('all_users');
			}
		}else{
			flash('Sucedio un error', 'danger');
			return redirect('all_users');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

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
