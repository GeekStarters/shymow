<?php namespace App\Helpers;

use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Chat;
use App\Message;
use App\Perfil;
use Hash;
use DB;
use Carbon\Carbon;
use DateTime;
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

	public static function knowTime($time){
		$from = new DateTime($time);
		$to = new DateTime();
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
}