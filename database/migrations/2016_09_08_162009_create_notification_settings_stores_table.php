<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationSettingsStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_settings_stores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
			$table->boolean('sound_notification');
			$table->boolean('sound_new_message');
			$table->boolean('sound_sale');
			$table->boolean('buy_notification');
			$table->boolean('label_notification');
			$table->boolean('like_notification');
			$table->boolean('share_notification');
			$table->boolean('message_notification');
			$table->boolean('qualification_notification');
			$table->integer('comments_notification');
			$table->boolean('email_notification');
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
		Schema::drop('notification_settings_stores');
	}

}
