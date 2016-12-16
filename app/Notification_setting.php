<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification_setting extends Model {

	protected $fillable = ['perfil_id','follow_notification','follow_out_notification','label_notification','like_notification','message_notification','qualification_notification','comments_notification','new_product_notification','trends_notification','share_notification','play_reseiver_notification','play_reseiver_msg','reseiver_email','active','id'];
}
