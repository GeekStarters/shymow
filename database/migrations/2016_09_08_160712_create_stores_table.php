<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profile_id')->unsigned();
			$table->foreign('profile_id')->references('id')->on('perfils')->onDelete('cascade');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email_store');
			$table->string('phone');
			$table->string('address');
			$table->string('further_office');
			$table->boolean('store_close')->default(false);
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
		Schema::drop('stores');
	}

}
