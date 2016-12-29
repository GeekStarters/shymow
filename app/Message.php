<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Message extends Model {

	protected $fillable = ['id','emisor','receptor','chat_id','active','message','read'];

	public function scopeChatMessage($query,$user)
	{
		return DB::select('SELECT chats.id as chatId,chats.channel, messages.emisor,messages.receptor,messages.message,messages.id as messageId,messages.read, messages.created_at FROM messages INNER JOIN chats ON messages.chat_id = chats.id INNER JOIN (SELECT MAX(id) idMax FROM messages GROUP BY chat_id) TM ON messages.id = TM.idMax WHERE chats.userOne = "'.$user.'" OR chats.userTwo = "'.$user.'" AND chats.active = true and messages.active = true GROUP BY chats.id ORDER BY messages.id DESC');
	}

	public function scopeCountMessageReseiver($query,$user)
	{
		return DB::select('SELECT messages.emisor,messages.receptor,messages.message,messages.id as messageId,messages.read, messages.created_at FROM messages WHERE messages.receptor = "'.$user.'" and messages.active = true and messages.read = false');
	}
}
