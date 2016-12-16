<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('perfil_id')->unsigned();
			$table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
			$table->boolean('follow_notification')->default(true);
			$table->boolean('follow_out_notification')->default(true);
			$table->boolean('label_notification')->default(true);
			$table->boolean('like_notification')->default(true);
			$table->boolean('message_notification')->default(true);
			$table->boolean('qualification_notification')->default(true);
			$table->boolean('comments_notification')->default(true);
			$table->boolean('new_product_notification')->default(true);
			$table->boolean('trends_notification')->default(true);
			$table->boolean('share_notification')->default(true);
			$table->boolean('play_reseiver_notification')->default(true);
			$table->boolean('play_reseiver_msg')->default(true);
			$table->string('reseiver_email')->default(true);
			$table->boolean('active')->default('0');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notification_settings');
	}

}
