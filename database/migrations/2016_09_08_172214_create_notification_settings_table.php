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
			$table->boolean('follow_notification');
			$table->boolean('follow_out_notification');
			$table->boolean('label_notification');
			$table->boolean('like_notification');
			$table->boolean('message_notification');
			$table->boolean('qualification_notification');
			$table->boolean('comments_notification');
			$table->boolean('new_product_notification');
			$table->boolean('trends_notification');
			$table->boolean('share_notification');
			$table->boolean('active')->default(true);
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
