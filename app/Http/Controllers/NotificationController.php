<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Perfil;
use Auth;
use App\Helpers\DataHelpers;
use DateTime;
use App\Notification_setting;
use Validator;
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
                $html .=                    '<img style="width:100%;" src="'.$message["userViewImage"].'" alt="shymow">';
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
			echo '<span style="color:#000; font-family:gothamTwo;">Mensajes 0</span>';
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
		return view('logueado.my_notifications');
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
