<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_shares', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned(); // User to share
			$table->foreign('user_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('profil_id')->unsigned(); // user make share
			$table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');

			$table->integer('new_post_id')->unsigned();
			$table->foreign('new_post_id')->references('id')->on('posts')->onDelete('cascade');
			
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
		Schema::drop('user_shares');
	}

}
