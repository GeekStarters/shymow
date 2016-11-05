<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('chat_id')->unsigned();
			$table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
			$table->integer('emisor')->unsigned();
			$table->foreign('emisor')->references('id')->on('profils')->onDelete('cascade');
			$table->integer('receptor')->unsigned();
			$table->foreign('receptor')->references('id')->on('profils')->onDelete('cascade');
			$table->boolean('read')->default(false);
			$table->boolean('active')->default(true);
			$table->text('message');
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
		Schema::drop('messages');
	}

}
