<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQualificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_qualifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned(); // Reseiver qualification
			$table->foreign('user_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('profil_id')->unsigned(); // Send qualification
			$table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
			$table->integer('qualification');
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
		Schema::drop('user_qualifications');
	}

}
