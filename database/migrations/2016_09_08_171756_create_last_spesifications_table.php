<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastSpesificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('last_spesifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('first_spesification_id')->unsigned();
			$table->foreign('first_spesification_id')->references('id')->on('first_spesifications')->onDelete('cascade');
			$table->string('name');
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
		Schema::drop('last_spesifications');
	}

}
