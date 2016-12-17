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
			$table->boolean('sound_notification')->default(true);
			$table->boolean('sound_new_message')->default(true);
			$table->boolean('sound_sale')->default(true);
			$table->boolean('buy_notification')->default(true);
			$table->boolean('label_notification')->default(true);
			$table->boolean('like_notification')->default(true);
			$table->boolean('share_notification')->default(true);
			$table->boolean('message_notification')->default(true);
			$table->boolean('qualification_notification')->default(true);
			$table->boolean('comments_notification')->default(true);
			$table->string('email_notification')->default('0');
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
