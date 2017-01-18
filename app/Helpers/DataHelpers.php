<?php namespace App\Helpers;

use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Chat;
use App\Message;
use App\LikeProduct;
use App\Perfil;
use App\UserLikes;
use App\UserQualification;
use App\UserShare;
use App\Notification_setting;
use App\Notification_settings_store;
use App\MyNotification;
use App\Comment_post;
use App\Post;
use App\Friend;
use Hash;
use DB;
use Carbon\Carbon;
use App\Product;
use App\Qualification_product;
use App\CommentProduct;
use App\ShareProduct;
use App\Store;
use DateTime;
use OpenGraph;
class DataHelpers{

	public static function latestPosts($idUser){
		function getSubString($string,$length)
		{
		    //Si no se especifica la longitud por defecto es 50
		    if ($length == NULL)
		        $length = 50;
		    //Primero eliminamos las etiquetas html y luego cortamos el string
		    $stringDisplay = substr(strip_tags($string), 0, $length);
		    //Si el texto es mayor que la longitud se agrega puntos suspensivos
		    // if (strlen(strip_tags($string)) > $length)
		    if (strlen($string) > $length)
		        $stringDisplay .= ' ...';
		    return $stringDisplay;
		}
		$chats = Message::chatMessage($idUser);

		// dd($chats);
		$messages = [];
		foreach ($chats as $chat) {
			$id = $idUser;
			$getUser = "";
			if ($chat->emisor == $id){
				$getUser = Perfil::where('id',$chat->receptor)->get();
			}else{
				$getUser = Perfil::where('id',$chat->emisor)->get();
			}

			$tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $chat->created_at);
			$tiempo = $tiempo->format('Y-m-d H:i');
			

			$texto = getSubString($chat->message,15);
			$newContainer = [
				"emisor" => $chat->emisor,
				"receptor" => $chat->receptor,
				"chat" => $chat->chatId,
				"key" => $chat->channel,
				"read" => $chat->read,
				"message" => $texto,
				"userViewName" => $getUser[0]->name,
				"userViewImage" => $getUser[0]->img_profile,
				"userViewId" => $getUser[0]->id,
				"messageTime" => $tiempo,
			];

			array_push($messages, $newContainer);
		}
		return $messages;
	}
	public static function knowMessageUnread()
	{
		$messages = Message::whereReceptor(Auth::id())->whereActive(true)->whereRead(false)->count();
		return $messages;
	}
	public static function knowTime($time){
		$from = new DateTime($time);
		$to = new DateTime(date("Y-m-d H:i:s"));
		$time = $to->diff($from, true);
		$date = "";
		if ($time->s > 0) {
			if ($time->i > 0) {
				if ($time->h > 0) {
					if ($time->d > 0) {
						if ($time->m > 0) {
							if ($time->y > 0) {
								$date = $time->y." años ".$time->m." meses";
							}else{
								$date = $time->m." meses ".$time->d." días" ;
							}
						}else{
							$date = $time->d." días" ;
						}
					}else{
						$date = $time->h."h";
					}
				}else{
					$date = $time->i."m";
				}
			}else{
				$date = $time->s."s";
			}
		}else{
			$date = "0s";
		}

		if ($date == "") {
			$date = "0s";
		}
		return $date;
	}

	public static function createLike($id_object,$tableToCount,$tableLike,$columnSame,$columnProfile,$modelIncrementLike,$modelLike){
		$count_object = DB::select('SELECT * FROM '.$tableToCount.' WHERE active = true and id = '.$id_object);
		$object_id = Auth::user()->id;

		if (count($count_object)>0) {

			$like = DB::select('SELECT * FROM '.$tableLike.' WHERE ('.$columnSame.' = '.$id_object.' and '.$columnProfile.' = '.$object_id.') and (`active` = true and `like` = true)');

			$like_edit = DB::select('SELECT * FROM '.$tableLike.' WHERE ('.$columnSame.' = '.$id_object.' and '.$columnProfile.' = '.$object_id.') and (`active` = true and `like` = false)');

			if (count($like) < 1 and count($like_edit)<1) {
				$new_like = new $modelLike();
					$new_like->like = true;
					$new_like->$columnSame = $id_object;
					$new_like->$columnProfile = $object_id;
				$new_like->save();

				$count_like = DB::select('SELECT * FROM '.$tableLike.' WHERE '.$columnSame.' = '.$id_object.' and ('.$tableLike.'.like = true and '.$tableLike.'.active = true)');

				$count_like = count($count_like);

				if ($count_like > 0) {
					$edit_user = $modelIncrementLike;
						$edit_user->like = $count_like;
					try {
						$edit_user->save();
						return "Like";
					} catch (Exception $e) {
						return "error";
					}
				}
			}elseif (count($like_edit) > 0) {
				$like_id = $like_edit['0']->id;

				$edit_like = $modelLike::find($like_id);
					$edit_like->like = true;
				$edit_like->save();

				$count_like = DB::select('SELECT * FROM '.$tableLike.' WHERE '.$columnSame.' = '.$id_object.' and ('.$tableLike.'.like = true and '.$tableLike.'.active = true)');
				
				try {
					$edit_user = $modelIncrementLike::where('id','=',$id_object)->update(['like'=>count( $count_like)]);
					return "like";
				} catch (Exception $e) {
					return "error";
				}
			}

			if (count($like) > 0) {
				$like_id = $like['0']->id;

				$edit_like = $modelLike::find($like_id);
					$edit_like->like = false;
				$edit_like->save();

				$count_like = DB::select('SELECT * FROM '.$tableLike.' WHERE '.$columnSame.' = '.$id_object.' and ('.$tableLike.'.like = true and '.$tableLike.'.active = true)');

				$edit_user = $modelIncrementLike::where('id','=',$id_object)->update(["like"=>count($count_like)]);
		
				
				
				return "like";
			}
		}
	}

	public static function verifyNotificationShop($type,$post_id,$store){
		$config = Notification_settings_store::where('store_id','=',$store)->first();
		if (count($store) > 0) {
			switch ($type) {
				//Qualification
				case 0:
					return ['type'=>'Calificarón Producto','notify'=>$config->qualification_notification,'sound'=>$config->sound_notification];
					break;
				//Like
				case 1:

					return ['type'=>'Me gusta Producto','notify'=>$config->like_notification,'sound'=>$config->sound_notification];
					break;
				//Sell
				case 2:
					return ['type'=>'Producto vendido','notify'=>$config->buy_notification,'sound'=>$config->sound_notification];
					break;
				//Share
				case 3:
					return ['type'=>'Compartió producto','notify'=>$config->share_notification,'sound'=>$config->sound_notification];
					break;
				//Comments
				case 4:
					return ['type'=>'Comento producto','notify'=>$config->comments_notification,'sound'=>$config->sound_notification];
					break;
				//Friend
				case 5:
					return ['type'=>'Dejo de gustar','notify'=>$config->like_notification,'sound'=>$config->sound_notification];
					break;
				default:
					return false;
					break;
			}
		}
		
	}
	public static function createQualification($post_id,$qualification,$modelQualification,$modelProduct,$columnSearch,$profilIdColumn){
		//user ID
		$user_id = Auth::user()->id;
		//Verificar si el usuario a calificado post
		$exists_user_active = $modelQualification::where('active',true)->where($columnSearch,$post_id)->where($profilIdColumn,$user_id)->count();

		//Verifica si el usuario no ha calificado post
		$exists_user_false = $modelQualification::where('active',false)->where($columnSearch,$post_id)->where($profilIdColumn,$user_id)->count();

		//Id user

		//Verificamos si existe post
		$post_exist = $modelProduct::where('active',true)->where('id',$post_id)->count();

		//Pasamos la puntuacion a un entero
		if (!empty($qualification)) {
			$qualification = (int) $qualification;
		}

		if ($post_exist > 0) {
			//Validamos que no exista calificacion

			if ($exists_user_active < 1 && $exists_user_false < 1) {
				//Si no existe calificacion del post por este usuario la creamos
				$newQualification = new $modelQualification();
					$newQualification->$columnSearch = $post_id;
					$newQualification->$profilIdColumn = $user_id;
					$newQualification->qualification = $qualification;

				try {
					$newQualification->save();

					//Traemos todas las calificaciones
					$get_qualification_post = $modelQualification::where('active',true)
												->where($columnSearch,$post_id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);
					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = $modelProduct::where('active',true)->where('id',$post_id) ->update(['qualification' => $media]);
						//retornamos el promedio o el error
						return ['error' => false, 'qualification' => $media];
					} catch (Exception $e) {
						return ['error' => true, 'description' => $e->getMessage()];
					}
				} catch (Exception $e) {
					return ['error' => true, 'description' => $e->getMessage()];
				}

				// Si el usuario ya califico editamos esa misma calificacion
			}elseif ($exists_user_active > 0 && $exists_user_false < 1) {
				//Guardamos lo editado
				try {
					$qualification_edit = $modelQualification::where('active',true)->where($columnSearch,$post_id)->where($profilIdColumn,$user_id)->update(['qualification' => $qualification]);

					//Traemos todas las calificaciones
					$get_qualification_post = $modelQualification::where('active',true)
												->where($columnSearch,$post_id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);
					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = $modelProduct::where('active',true)->where('id',$post_id)->update(['qualification' => $media]);

						//retornamos el promedio o el error
						return ['error' => false, 'qualification' => $media];
					} catch (Exception $e) {
						return ['error' => true, 'description' => $e->getMessage()];
					}
				} catch (Exception $e) {
					return ['error' => true, 'description' => $e->getMessage()];
				}

				//Si el usuario habia calificado antes pero esta desactivada la activamos y editamos
			}elseif ($exists_user_active < 1 && $exists_user_false > 0) {
				try {
					$qualification_edit = $modelQualification::where('active',false)->where($columnSearch,$post_id)->where($profilIdColumn,$user_id)->update(['qualification' => $qualification,'active' => true]);
					

					//Traemos todas las calificaciones
					$get_qualification_post = $modelQualification::where('active',true)
												->where($columnSearch,$post_id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);

					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = $modelProduct::where('active',true)->where('id',$post_id) ->update(['qualification' => $media]);
						//retornamos el promedio o el error
						return ['error' => false, 'qualification' => $media];
					} catch (Exception $e) {
						return ['error' => true, 'description' => $e->getMessage()];
					}
				} catch (Exception $e) {
					return ['error' => true, 'description' => $e->getMessage()];
				}
			}
		}
	}

	public static function getSubString($string, $length=NULL)
	{
	    //Si no se especifica la longitud por defecto es 50
	    if ($length == NULL)
	        $length = 50;
	    //Primero eliminamos las etiquetas html y luego cortamos el string
	    $stringDisplay = substr(strip_tags($string), 0, $length);
	    //Si el texto es mayor que la longitud se agrega puntos suspensivos
	    if (strlen(strip_tags($string)) > $length)
	        $stringDisplay .= ' ...';
	    return $stringDisplay;
	}

	public static function knowTypeNotification($type,$reseiver){
			$config = Notification_setting::where('perfil_id','=',$reseiver)->count();
		
			if ($config < 1) {
				$notifications = new Notification_setting();
			    	$notifications->perfil_id = (int)$reseiver;
			    $notifications->save();
			    $config = Notification_setting::where('perfil_id','=',$reseiver)->first();
			   
			}else{
				$config = Notification_setting::where('perfil_id','=',$reseiver)->first();

			}

			switch ($type) {
				//Qualification
				case 0:
					return ['type'=>'Calificarón Post','notify'=>$config->qualification_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Like
				case 1:

					return ['type'=>'Me gusta Pos','notify'=>$config->like_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Follow
				case 2:
					return ['type'=>'Sigue post','notify'=>$config->follow_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Share
				case 3:
					return ['type'=>'Compartió Post','notify'=>$config->share_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Comments
				case 4:
					return ['type'=>'Comento Post','notify'=>$config->comments_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Friend
				case 5:
					return ['type'=>false,'notify'=>false];
					break;
				//Unfollow
				case 6:
					return ['type'=>'Dejo de seguir Post','notify'=>$config->follow_out_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Message
				case 7:
					return ['type'=>'Envio Mensaje','notify'=>$config->message_notification,'sound'=>$config->play_reseiver_msg];
					break;
				//Unlike
				case 8:
					return ['type'=>'Dejo de gustar','notify'=>$config->like_notification,'sound'=>$config->play_reseiver_notification];
					break;
				//Friend
				case 9:
					return ['type'=>'Solicito amistad','notify'=>true];
					break;
				default:
					return false;
					break;
			}
	}




	public static function knowNotificationNum(){
		$count = "";
		if (Auth::id() != 0) {
			$count = DB::table('my_notifications')
			->where('my_notifications.active',true)
			->where('my_notifications.read',false)
			->where('my_notifications.reseiver',Auth::id())
			->count();
			$count += DB::table('my_notification_shops')
			->where('my_notification_shops.active',true)
			->where('my_notification_shops.read',false)
			->where('my_notification_shops.reseiver',Auth::id())
			->count();
		}else{
			$count = DB::table('my_notifications')
			->where('my_notifications.active',true)
			->where('my_notifications.read',false)
			->where('my_notifications.reseiver',Auth::id())
			->count();

		}
		return $count;
	}

	public static function knowNotificationFriend(){
		$count = DB::table('my_notifications')
		->where('my_notifications.active',true)
		->where('my_notifications.read',false)
		->where('my_notifications.type',9)
		->where('my_notifications.reseiver',Auth::id())
		->count();
		return $count;
	}

	public static function knowPendingFriends(){
		$id = Auth::id();
		$pendings = DB::select('SELECT * FROM friends WHERE user2 = '.$id.' AND status = 0');

		return count($pendings);
	}


	public static function viewPage($text){
		$graph = OpenGraph::fetch(OpenGraph::findURL($text));
		$html = "";
		$multimedia = "";

		if ($graph != false) {
			$html .= '<div class="well">';
			foreach ($graph as $key => $value) {
				if($key == "image"){
					$multimedia ='<img class="img-responsive" src="'.$value.'">';
				}
				if ($key == "video:url") {
					$multimedia ='<div class="embed-responsive embed-responsive-16by9">
  							<iframe class="embed-responsive-item"  src="'.$value.'" frameborder="0" allowfullscreen>
  							</iframe>
  					</div>';
				}
				$html .= ($key == "title") ? '<h4> '.utf8_decode(strtoupper($value)).' </h4>' : '';
				$html .= ($key == "site_name") ? '<h4> '.utf8_decode(strtoupper($value)).' </h4>' : '';
  				$html .= ($key == "description")? "<p> ".utf8_decode($value)." </p>" : '';
			}

			$html .= $multimedia;
  			$html .= "</div>";
			return $html;
		}

		return '';
		
	}
}