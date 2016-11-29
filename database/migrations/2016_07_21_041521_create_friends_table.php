<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('friends', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user1');
			$table->foreign('user1')->references('id')->on('perfils')->onDelete('cascade');
			$table->integer('user2');
			$table->foreign('user2')->references('id')->on('perfils')->onDelete('cascade');
			$table->boolean('active')->default(true);
			$table->integer('status')->default(0);
			// 0 Pendiente
			// 1 Aceptado
			// 2 denegado
			// 3 bloqueado
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
		Schema::drop('friends');
	}

}
