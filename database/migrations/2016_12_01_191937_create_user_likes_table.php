<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_likes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned(); //Reseived Like 
			$table->foreign('user_id')->references('id')->on('profils')->onDelete('cascade');
			$table->integer('profil_id')->unsigned(); // Send Like
			$table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
			$table->boolean('like');	
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
		Schema::drop('user_likes');
	}

}
