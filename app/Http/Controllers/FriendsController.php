<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Perfil;
use App\Friend;
use App\MyNotification;
use Activity;
use DataHelpers;
class FriendsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function online(){
		$activities = Activity::users(10)->get();// 10 minutes

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

		$friends_online = [];
        foreach ($activities as $activity) {
            foreach ($user_contents as $key => $friend) {
            	if ($activity->user->id == $friend->id) {
            		array_push($friends_online,$activity);
            	}
            }
        }

        if (count($friends_online) > 0) {
        	foreach ($friends_online as $onlie) {
        		$html = '<div class="online-detail-user" data-user="'.$onlie->user->id.'" tabindex="0" role="button" data-toggle="popover" data-trigger="focus"><div class="row chat-content-view" style="cursor:pointer;">'.'<div style="color:#000;">'.'<div class="clearfix"></div>'.'<div class="col-xs-4" style="position:relative;">'.'<img style="width:100%;border-radius:5px;" src="/'.$onlie->user->img_profile.'" alt="shymow">'.'<span style="position:absolute;background:#00A02F;bottom:5px;right: 20px;padding:5px;border-radius: 50%;border: 1px solid #fff;"></span>'.'</div>'.'<div class="col-xs-6">'.'<div style="font-weight: bold;">'.'<div style="font-size:1.1em;float:left;margin-top:10px;color:#676665;">'.$onlie->user->name.'</div>'.'</div>'.'<div class="clearfix"></div>'.'</div>'.'</div>'.'</div>'.'</div>'.'<div class="clearfix"></div>'.'<hr>';
        		echo $html;
        	}
        }else{
    		echo '<span style="color:#000; font-size:1.2em; font-family:gothamTwo;">Online 0</span>';
    	}
	}

	public function onlineDetail($id){
		
		$user = Perfil::where('id','=',$id)->get();
		if (count($user) > 0) {
			$detail = $user[0];

			$userRedes = "";
			if (isset($detail->redes) && $detail->redes != "") {
				$redes = json_decode($detail->redes,true);
				$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
				foreach ($socialNet as $social) {
					if (isset($redes[$social])) {
						foreach ($redes[$social] as $red) {
							$userRedes .= '<a href="'.$red.'" target="_blank"><img src="/img/profile/'.$social.'-post.png" style="width:20px;"></a>';
						}
					}
				}
			}
			$html = "";
			$html .=           '<a href="/view_user/'.$detail->id.'" style="color:#000;text-decoration:none;">';
			$html .=            '<div class="row chat-content-view">';
            $html .=            '<div style="color:#000;cursor:pointer;">';
            $html .=                '<div class="clearfix"></div>';
            $html .=                '<div class="col-xs-3">';
            $html .=                    '<img style="width:100%;" src="/'.$detail->img_profile.'" alt="shymow">';
            $html .=                '</div>';
            $html .=                '<div class="col-xs-9">';
            $html .=                    '<div style="font-weight: bold;">';
            $html .=                        '<div style="float:left;">';
            $html .=                            $detail->name;
            $html .=                        '</div>';
            $html .=                    '</div>';
            $html .=                    '<div class="clearfix"></div>';
            $html .=                    '<div style="font-size:.9em;">';
            $html .=                        '<i>'.$detail->mi_frase.'</i>';
            $html .=                    '</div>';
            $html .=                    '<div class="clearfix"></div>';
            $html .=                    '<div style="font-size:.9em;">';
            $html .=                      	$userRedes;
            $html .=                    '</div>';
            $html .=                '</div>';
            $html .=            '</div>';
            $html .=            '</div>';
            $html .=           '</a>';
            $html .=            '<div class="clearfix"></div>';
            echo $html;
		}
	}

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
		//User to accept
		$user_accept = [];
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
					array_push($user_accept, [$pending->user1,$pending->user2]);
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
		return view('logueado.add_users',compact('users','user_blocked','user_contents','user_pending','user_declined','user_accept'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function acceptFriends($id = null)
	{
		if ($id != null) {
			$count = Perfil::where('id',$id)->where('active',true)->count();
			if ($count>0) {
				if ($id != Auth::id()) {
					$relation = Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->get();

					if (count($relation)>0) {
						if($relation[0]->status == 0){
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>1]);
							flash('Solicitud de amistad aceptada', 'success');
						}
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
										->update(['status'=>0,'user1'=>Auth::id(),'user2'=>$id]);
							$newNoti = new MyNotification;
			    			$newNoti->sender = Auth::id();
			    			$newNoti->reseiver = $id;
			    			$newNoti->type = 9;
			    			$newNoti->description = DataHelpers::knowTypeNotification(9);
			    			$newNoti->save();
						flash('Solicitud de amistad enviada', 'success');
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

						$newNoti = new MyNotification;
		    			$newNoti->sender = Auth::id();
		    			$newNoti->reseiver = $id;
		    			$newNoti->type = 9;
		    			$newNoti->description = DataHelpers::knowTypeNotification(9);
		    			$newNoti->save();
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
	public function friendship(){
		//Stack users
		$user_pending = [];
		//ID user pending
		$id = Auth::id();
		$pendings = DB::select('SELECT * FROM friends WHERE user2 = '.$id.' AND status = 0');
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
				$user = Perfil::where('id',$user_id)
								->where('active',true)
								->first();
				//If return user is more than one and less than two
				if (count($user)>0 && count($user) < 2) {
					array_push($user_pending, $user);
				}
			}
		}
		//READ					
		DB::table('my_notifications')
			->where('my_notifications.active',true)
			->where('my_notifications.reseiver',Auth::id())
			->where('my_notifications.type','=',9)
			->update(['read'=>true]);
		return view('logueado.friendship',compact('user_pending'));
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
