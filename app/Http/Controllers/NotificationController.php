<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Perfil;
use Auth;
use DateTime;
use App\Notification_setting;
use Validator;
use DB;
use DataHelpers;
use App\MyNotification;
class NotificationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$config = Notification_setting::where('perfil_id','=',Auth::id())->first();
		$opt1 = true;
		$opt2 = true;
		$opt3 = true;
		if (count($config)>0) {
			if ($config->reseiver_email != "0") {
				$opt1 = false;
				if ($config->reseiver_email != "1") {
					$opt2 = false;
				}
				if ($config->reseiver_email != "2") {
					$opt3 = false;
				}
			}elseif($config->reseiver_email != "1") {
				$opt2 = false;
				if ($config->reseiver_email != "0") {
					$opt1 = false;
				}
				if ($config->reseiver_email != "2") {
					$opt3 = false;
				}
			}elseif($config->reseiver_email != "2") {
				$opt3 = false;
				if ($config->reseiver_email != "0") {
					$opt1 = false;
				}
				if ($config->reseiver_email != "1") {
					$opt2 = false;
				}
			}
		}
		return view('logueado.config-notification',compact('config','opt1','opt2','opt3'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function saveConfNotification(Request $re){
		$v = Validator::make($re->all(), [
	        'follow_notification' => 'required',
	        'follow_out_notification' => 'required',
	        'label_notification' => 'required',
	        'like_notification' => 'required',
	        'message_notification' => 'required',
	        'qualification_notification' => 'required',
	        'comments_notification' => 'required',
	        'new_product_notification' => 'required',
	        'trends_notification' => 'required',
	        'reseiver_email' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }

	    $sound_n = $re->input('play_reseiver_notification');
	    $sound_msg = $re->input('play_reseiver_msg');

	    $bool_s_n = false;
	    $bool_s_msg = false;
	    if ($sound_n == "true") {
	    	$bool_s_n = true;
	    }
	    if ($sound_msg == "true") {
	    	$bool_s_msg = true;
	    }

	   	try {
	   		$notifify = Notification_setting::where('perfil_id','=',Auth::id())->update([
	   			'follow_notification' => $re->input('follow_notification'),
		        'follow_out_notification' => $re->input('follow_out_notification'),
		        'label_notification' => $re->input('label_notification'),
		        'like_notification' => $re->input('like_notification'),
		        'message_notification' => $re->input('message_notification'),
		        'qualification_notification' => $re->input('qualification_notification'),
		        'comments_notification' => $re->input('comments_notification'),
		        'new_product_notification' => $re->input('new_product_notification'),
		        'trends_notification' => $re->input('trends_notification'),
		        'reseiver_email' => $re->input('reseiver_email'),
		        'play_reseiver_notification' => $bool_s_n,
		        'play_reseiver_msg' => $bool_s_msg,
	   		]);
	   		flash('Configuración de notificaciones guardada', 'success');
	    	return redirect()->back();
	   	} catch (Exception $e) {
	   		flash('Intentalo nuevamente', 'danger');
	    	return redirect()->back();
	   	}
	}
	public function notifyGetMessages(){
		$messages = DataHelpers::latestPosts(Auth::id());
		if (count($messages) > 0) {
			$html = "";
			$f = 0;
			foreach ($messages as $message) {
				$f++;
				if ($f==3) {
					break;
				}
				$html .=            '<div class="row chat-content-view">';
                $html .=            '<div style="color:#000;cursor:pointer;">';
                $html .=                '<div class="clearfix"></div>';
                $html .=                '<div class="col-xs-3">';
                $html .=                    '<img style="width:100%;" src="/'.$message["userViewImage"].'" alt="shymow">';
                $html .=                '</div>';
                $html .=                '<div class="col-xs-9">';
                $html .=                    '<div style="font-weight: bold;">';
                $html .=                        '<div style="float:left;">';
                $html .=                            $message["userViewName"];
                $html .=                        '</div>';
                $html .=                        '<div style="float:right;"">';
                $html .=                            DataHelpers::knowTime($message['messageTime']);
                $html .=                        '</div>';
                $html .=                    '</div>';
                $html .=                    '<div class="clearfix"></div>';
                $html .=                    '<div style="font-size:.9em;">';
                $html .=                        $message["message"];
                $html .=                    '</div>';
                $html .=                '</div>';
                $html .=            '</div>';
	            $html .=            '</div>';
	            $html .=            '<div class="clearfix"></div>';
	            $html .=            '<hr>';

			}
			
	            $html .= '<a href="/messages" class="text-center">Ver todos</>';
	            echo $html;
		}else{
			echo '<span style="color:#000; font-family:gothamTwo;">Mensajes 0</span><br><a href="/messages">Ver todos</a>';
		}
		
	}
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
	public function myNotifications()
	{
		$notifications = DB::table('my_notifications')
							->join('perfils', 'perfils.id', '=', 'my_notifications.sender')
							->leftJoin('posts', 'posts.id', '=', 'my_notifications.object_id')
							->select('perfils.id as senderId', 'perfils.name', 'perfils.img_profile','my_notifications.sender','my_notifications.type','my_notifications.description','my_notifications.object_id','my_notifications.read','posts.description as postsDescription','my_notifications.created_at as time','my_notifications.id as notification_id')
							->where('my_notifications.active',true)
							->where('my_notifications.reseiver',Auth::id())
							->where('my_notifications.type','<>',9)
							->take(15)->orderBy('my_notifications.id', 'desc')->get();
		//COUNT
			$count = DB::table('my_notifications')
			->where('my_notifications.active',true)
			->where('my_notifications.read',false)
			->where('my_notifications.type','<>',9)
			->where('my_notifications.reseiver',Auth::id())
			->count();

		//READ					
		DB::table('my_notifications')
			->where('my_notifications.active',true)
			->where('my_notifications.reseiver',Auth::id())
			->where('my_notifications.type','<>',9)
			->update(['read'=>true]);
		return view('logueado.my_notifications',compact('notifications','count'));
	}

	public function getNotificationType(Request $request)
	{
		$v = Validator::make($request->all(), [
	        'type' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error'=>true]);
	    }

	    $type = (int) $request->input('type');
	    $notifications = DB::table('my_notifications')
						->join('perfils', 'perfils.id', '=', 'my_notifications.sender')
						->join('posts', 'posts.id', '=', 'my_notifications.object_id')
						->select('perfils.id as senderId', 'perfils.name', 'perfils.img_profile','my_notifications.sender','my_notifications.type','my_notifications.description','my_notifications.object_id','my_notifications.read','posts.description as postsDescription','my_notifications.created_at as time','my_notifications.id as notification_id')
						->where('my_notifications.active',true)
						->where('my_notifications.reseiver',Auth::id())
						->where('my_notifications.type',$type)
						->take(15)->orderBy('my_notifications.id', 'desc')->get();

		foreach($notifications as $notification){
			$html = "";

			if($notification->read){
				$html .= '<div class="content-notifications">';
			}else{
				$html .= '<div class="content-notifications notification_unread">';
			}
				$html .= '<div class="checkbox">';
				    $html .= '<label style="width: 100%">';
				      $html .= '<input type="checkbox" value="'.$notification->notification_id.'">';
				      $html .= '<div class="notification-body">';
				      	$html .= '<div class="type-notification">';
				      		$html .= '<img src="/'.$notification->img_profile.'" class="img-responsive" alt="">';
				      		$html .= '<img src="/img/icon_notification/'.$notification->type.'.png">';
				      	$html .= '</div>';
				      	$html .= '<span class="description-notification hashtag-post"><i><a href="/view_user/'.$notification->senderId.'"> '.$notification->name.'</a> '.$notification->description.'</i> - '.DataHelpers::knowTime($notification->time).' <br>'.$notification->postsDescription.'</span>';
				      $html .= '</div>';
				    $html .= '</label>';
				$html .= '</div>';
				$html .= '<hr>';
			$html .= '</div>';

			echo $html;
		}
	}
	public function deleteNotification(Request $request){
		$v = Validator::make($request->all(), [
	        'data' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error'=>true]);
	    }

	    $data = $request->input('data');
	    $data = explode(',', $data);
	    
	    try {
	    	foreach ($data as $val) {
	    		MyNotification::where('id',$val)->update(['active'=>false]);
	    	}
	    	return response()->json(['error'=>false,'message' => 'Tus datos fueron eliminados']);
	    } catch (Exception $e) {
	    	return response()->json(['error'=>true,'message' => "Vuelve a intentarlo"]);
	    }
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


	function saveNotification(Request $request)
	{
		$v = Validator::make($request->all(), [
	        'sender' => 'required',
	        'reseiver' => 'required',
	        'type' => 'required',
	        'objectId' => 'required',
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error'=>true]);
	    }

	    $sender = $request->input('sender');
	    $reseiver = $request->input('reseiver');
	    $type = (int) $request->input('type');
	    $objectId = (int) $request->input('objectId');

	    $userS = Perfil::where('identification','=',$sender)->first();
	    if (count($userS)>0) {
	    	$userR = Perfil::where('id','=',$reseiver)->first();
	    	if (count($userR)>0) {
	    		if (DataHelpers::knowTypeNotification($type) != false) {

	    			try {
	    				$newNoti = new MyNotification;
		    			$newNoti->sender = $userS->id;
		    			$newNoti->reseiver = $userR->id;
		    			$newNoti->type = $type;
		    			$newNoti->description = DataHelpers::knowTypeNotification($type);
		    			$newNoti->object_id = $objectId;
		    			$newNoti->save();

	    				return response()->json(['error'=>false,'name' => Auth::user()->name, 'identification' => $userR->identification, 'img' => Auth::user()->img_profile, 'description' => DataHelpers::knowTypeNotification($type)]);
	    			} catch (Exception $e) {
	    				return response()->json(['error'=>true]);
	    			}
	    		}else{
		    		return response()->json(['error'=>true]);
		    	}
	    	}else{
		    	return response()->json(['error'=>true]);
		    }
	    }else{
	    	return response()->json(['error'=>true]);
	    }

	}


	function notificationUser($id)
	{
		$user = Perfil::where('id','=',$id)->get();
		if (count($user)>0) {
			$detail = $user[0];
			return response()->json(['error'=>false,'name' => Auth::user()->name, 'identification' => $detail->identification, 'img' => Auth::user()->img_profile]);
		}else{
			return response()->json(['error'=>true]);
		}
	}

}
