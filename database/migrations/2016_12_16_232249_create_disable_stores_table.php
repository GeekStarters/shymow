<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisableStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disable_stores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
			$table->string('description');
			$table->string('reasons');
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
		Schema::drop('disable_stores');
	}

}
