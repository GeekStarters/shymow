<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('my_notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sender')->unsigned();
			$table->foreign('sender')->references('id')->on('profils')->onDelete('cascade');
			$table->integer('reseiver')->unsigned();
			$table->foreign('reseiver')->references('id')->on('profils')->onDelete('cascade');
			$table->boolean('read')->default(false);
			$table->string('description')->nullable();
			$table->integer('object_id');
			$table->integer('type')->nullable();
			$table->integer('active')->default(true);;
			/**
			 * 0 = Qualification
			 * 1 = Like
			 * 2 = Follow
			 * 3 = Share
			 * 4 = Comments
			 * 5 = Friend
			 * 6 = Unfollow
			 * 7 = Message
			 * 8 = Unlike
			*/
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
		Schema::drop('my_notifications');
	}

}
