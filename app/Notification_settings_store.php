<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification_settings_store extends Model {

	protected $fillable = ['id','store_id','sound_notification','sound_new_message','sound_sale','buy_notification','label_notification','like_notification','message_notification','qualification_notification','comments_notification','email_notification','active'];

}
