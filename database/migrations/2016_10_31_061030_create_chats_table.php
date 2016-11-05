<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userOne')->unsigned();
			$table->foreign('userOne')->references('id')->on('profils')->onDelete('cascade');
			$table->integer('userTwo')->unsigned();
			$table->foreign('userTwo')->references('id')->on('profils')->onDelete('cascade');
			$table->string('name')->nullable();
			$table->boolean('active')->default(true);
			$table->string('channel', 60)->nullable();
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
		Schema::drop('chats');
	}

}
