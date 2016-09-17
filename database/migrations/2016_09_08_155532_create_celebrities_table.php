<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCelebritiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('celebrities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profile_id')->unsigned();
			$table->foreign('profile_id')->references('id')->on('perfils')->onDelete('cascade');
			$table->string('apodo');
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
		Schema::drop('celebrities');
	}

}
