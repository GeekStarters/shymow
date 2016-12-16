<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
use App\Helpers\DataHelpers;
class MessagesController extends Controller{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$messages = DataHelpers::latestPosts(Auth::id());
		return view('logueado.messages',compact('messages'));
	}

	public function channels(){
		$channels = Chat::channels(Auth::id())->get();
		$channels = json_encode($channels);
		try {
			return response()->json(['error' => false, 'data'=>$channels,'emisor'=>Auth::id()]);
		} catch (Exception $e) {
			return response()->json(['error' => true]);
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{

		$messages = [
		    'receiverid.required' => 'Todos los campos son requeridos',
		    'message.required' => 'Necesita escribir un mensaje',
		];
		$v = Validator::make($request->all(), [
	        'receiverid' => 'required',
	        'message' => 'required',
	    ],$messages);

	    if ($v->fails())
	    {
	        return response()->json(['error' => "required"]);
	    }


	    $destinatario_id = $request->input('receiverid');
	    $message = $request->input('message');

	    function validateChat($userOne,$userTwo,$active){
	    	$chat = Chat::where('userOne',$userOne)
	    				   ->where('userTwo',$userTwo)
	    				   ->where('active',$active)
	    				   ->get();
	    	return $chat;
	    }	

	    if (count(validateChat(Auth::id(),$destinatario_id,true)) < 1) {
			if (count(validateChat(Auth::id(),$destinatario_id,false)) < 1) {
				if (count(validateChat($destinatario_id,Auth::id(),true)) < 1) {
					if (count(validateChat($destinatario_id,Auth::id(),false)) < 1) {
				    	try{
					    	 	$newChat = new Chat();
							    	$newChat->userOne = Auth::user()->id;
							    	$newChat->userTwo = $destinatario_id;
							    	$newChat->channel = Hash::make($newChat->id);
						    	$newChat->save();

							    $newMessage = new Message();
							    	$newMessage->emisor = Auth::user()->id;
							    	$newMessage->receptor = $destinatario_id;
							    	$newMessage->message = $message;
							    	$newMessage->chat_id = $newChat->id;
							    $newMessage->save();
							$tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $newMessage->created_at);
							$tiempo = $tiempo->format('Y-m-d H:i');

						    $data = [
						    	'transmitter' => Auth::id(),
						    	"channel" => $newChat->channel,
						    	"tiempo" => $tiempo,
						    ];
						    $data = json_encode($data);
						    return response()->json(['error' => false,'data' => $data]);
					    } catch (Exception $e) {
					    	return response()->json(['error' => "chat 0"]);
					    }
					}
				}else{
					try {
						$dataChat = validateChat($destinatario_id,Auth::id(),true);
			    		$newMessage = new Message();
					    	$newMessage->emisor = Auth::user()->id;
					    	$newMessage->receptor = $destinatario_id;
					    	$newMessage->message = $message;
					    	$newMessage->chat_id = $dataChat[0]->id;
					    $newMessage->save();

					    $tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $newMessage->created_at);
						$tiempo = $tiempo->format('Y-m-d H:i');
					    $data = [
					    	'transmitter' => Auth::id(),
					    	"channel" => $dataChat[0]->channel,
					    	"tiempo" => $tiempo,
					    ];
					    $data = json_encode($data);
			    		return response()->json(['error' => false,'data' => $data]);
			    	} catch (Exception $e) {
			    		return response()->json(['error' => true]);
			    	}
				}
			}else{
				try {
					$updateChat = Chat::where('userOne',$destinatario_id)
	    				   ->where('userTwo',Auth::id())
	    				   ->where('active',true)
	    				   ->update(['active' => true])
	    				   ->get();

					$dataChat = validateChat($destinatario_id,Auth::id(),true);
		    		$newMessage = new Message();
				    	$newMessage->emisor = Auth::user()->id;
				    	$newMessage->receptor = $destinatario_id;
				    	$newMessage->message = $message;
				    	$newMessage->chat_id = $dataChat[0]->id;
				    $newMessage->save();

				    $tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $newMessage->created_at);
					$tiempo = $tiempo->format('Y-m-d H:i');
				    $data = [
				    	'transmitter' => Auth::id(),
				    	"channel" => $dataChat[0]->channel,
				    	"tiempo" => $tiempo,
				    ];
				    $data = json_encode($data);
			    	return response()->json(['error' => false,'data' => $data]);
		    	} catch (Exception $e) {
		    		return response()->json(['error' => true]);
		    	}
			}
	    }else{
	    	try {
				$dataChat = validateChat(Auth::id(),$destinatario_id,true);
	    		$newMessage = new Message();
			    	$newMessage->emisor = Auth::user()->id;
			    	$newMessage->receptor = $destinatario_id;
			    	$newMessage->message = $message;
			    	$newMessage->chat_id = $dataChat[0]->id;
			    $newMessage->save();
			    $tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $newMessage->created_at);
				$tiempo = $tiempo->format('Y-m-d H:i');
			    $data = [
			    	'transmitter' => Auth::id(),
			    	"channel" => $dataChat[0]->channel,
			    	"tiempo" => $tiempo,
			    ];
			    $data = json_encode($data);
			    return response()->json(['error' => false,'data' => $data]);
	    	} catch (Exception $e) {
	    		return response()->json(['error' => true]);
	    	}
	    }

	}
	/**
	 * SetMessage a newly create message in chat.
	 *
	 * @return JSON
	 */
	public function setMessage(Request $request){

		$v = Validator::make($request->all(), [
	        'channel' => 'required',
	        'msg' => 'required',
	        'transmitter' => 'required',
	        'receiver' => 'required'
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error' => true]);
	    }


	    $channel = $request->input('channel');
	    $message = $request->input('msg');
	    $transmitter = $request->input('transmitter');
	    $receiver = $request->input('receiver');

	    function validateChat($channel,$transmitter,$receiver){
	    	$chat = Chat::where('channel',$channel)
	    				->where('userOne',$transmitter)
	    				->where('userTwo',$receiver)
	    				->get();

	    	return $chat;
	    }
	    if (count(validateChat($channel,$transmitter,$receiver))>0) {
	    	try {
	    		$chat = validateChat($channel,$transmitter,$receiver);
	    		$idChat = $chat[0]->id;
	    		$idReceptor = "";
	    		if ($chat[0]->userOne == Auth::id())
	    			$idReceptor = $chat[0]->userTwo;
	    		else
	    			$idReceptor = $chat[0]->userOne;

	    		$newMessage = new Message();
			    	$newMessage->emisor = Auth::user()->id;
			    	$newMessage->receptor = $idReceptor;
			    	$newMessage->message = $message;
			    	$newMessage->chat_id = $idChat;
			    $newMessage->save();

			    $tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $newMessage->created_at);
				$tiempo = $tiempo->format('Y-m-d H:i');

			    $emisor = [
	    			"emisorName" =>Auth::user()->name,
	    			"emisorImg" =>Auth::user()->img_profile,
	    			"emisorId" =>Auth::user()->id,
	    			"time" =>$tiempo,
	    		];
	    		$emisor = json_encode($emisor);
			    return response()->json(['error' => false,'data' => $emisor]);
	    	} catch (Exception $e) {
	    		return response()->json(['error' => "first"]);
	    	}
	    }elseif(count(validateChat($channel,$receiver,$transmitter))>0){
	    	try {
	    		$chat = validateChat($channel,$receiver,$transmitter);
	    		$idChat = $chat[0]->id;
	    		$idReceptor = "";
	    		if ($chat[0]->userOne == Auth::id())
	    			$idReceptor = $chat[0]->userTwo;
	    		else
	    			$idReceptor = $chat[0]->userOne;

	    		$newMessage = new Message();
			    	$newMessage->emisor = Auth::user()->id;
			    	$newMessage->receptor = $idReceptor;
			    	$newMessage->message = $message;
			    	$newMessage->chat_id = $idChat;
			    $newMessage->save();

			    $tiempo = Carbon::createFromFormat('Y-m-d H:i:s', $newMessage->created_at);
				$tiempo = $tiempo->format('Y-m-d H:i');

			    $emisor = [
	    			"emisorName" =>Auth::user()->name,
	    			"emisorImg" =>Auth::user()->img_profile,
	    			"emisorId" =>Auth::user()->id,
	    			"time" =>$tiempo,
	    		];
	    		$emisor = json_encode($emisor);
			    return response()->json(['error' => false,'data' => $emisor]);
	    	} catch (Exception $e) {
	    		return response()->json(['error' => "second"]);
	    	}
	    }else{
	    	return response()->json(['error' => "nada"]);
	    }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return view('logueado.create_new_message');
	}

	public function getUser(Request $request){
		$v = Validator::make($request->all(), [
	        'transmitter' => 'required'
	    ]);

	    if ($v->fails())
	    {
	        return response()->json(['error' => true]);
	    }

	    $user = $request->input('transmitter');
	    $dataUser = Perfil::where('id',$user)->get();
	    if (count($dataUser)>0) {
	    	
			$data = [
				"name" => $dataUser[0]->name,
				"id" => $dataUser[0]->id,
				"img" => $dataUser[0]->img_profile,
			];
			$data = json_encode($data);
			return response()->json(['error' => false, 'data'=>$data]);
	    }else{
	    	return response()->json(['error' => true]);
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

	public function changeRead(Request $request)
	{
		$v = Validator::make($request->all(), [
        'channel' => 'required',
	    ]);

	    if ($v->fails())
	    {
	    	return response()->json(['error' => true, 'message'=>'Ocurrio un error']);
	    }

	    $channel = $request->input('channel');

	    $chat = Chat::where('channel',$channel)->get();

	    try {
	    	foreach ($chat as $data) {
	    		$getMessages = Message::where('chat_id',$data->id)->update(['read' => true]);
	    	}
	    	return response()->json(['error' => false]);
	    } catch (Exception $e) {
	    	return response()->json(['error' => true, 'message'=>'Ocurrio un error']);
	    }
	}

	public function allMesagess(Request $request){
		$v = Validator::make($request->all(), [
        'channel' => 'required',
	    ]);

	    if ($v->fails())
	    {
	    	return response()->json(['error' => true, 'message'=>'Ocurrio un error']);
	    }
	    $channel = $request->input('channel');
	    $chat = Chat::where('channel',$channel)->get();
	    $getMessages = "";

	    foreach ($chat as $data) {
	    	$getMessages = Message::where('chat_id',$data->id)
	    						->where('active',true)
	    						->take(20)
	    						->groupBy('id')
	    						->orderBy('id', 'asc')
	    						->get();
	    }
	    $message = [];
	    foreach ($getMessages as $get) {
	    	$getEmisor = "";
	    	$emisor = [];
	    	if ($get->emisor == Auth::user()->id) {
	    		$emisor = [
	    			"emisorName" =>Auth::user()->name,
	    			"emisorImg" =>Auth::user()->img_profile,
	    			"emisorId" =>Auth::user()->id,
	    		];
	    	}else{
	    		$getEmisor = Perfil::where('id',$get->emisor)->get();
	    		$emisor = [
	    			"emisorName" =>$getEmisor[0]->name,
	    			"emisorImg" =>$getEmisor[0]->img_profile,
	    			"emisorId" =>$getEmisor[0]->id,
	    		];
	    	}

	    	$newData = [
	    		"message" => $get->message,
	    	];

	    	$newData = array_merge($emisor,$newData);
	    	array_push($message, $newData);
	    }
	    $message = json_encode($message);

	    try {
	    	return response()->json(['error' => false, 'data'=>$message]);
	    } catch (Exception $e) {
	    	return response()->json(['error' => true, 'message'=>'Ocurrio un error']);
	    }
	}

}
