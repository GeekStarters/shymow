<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstSpesificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('first_spesifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type_product_id')->unsigned();
			$table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');
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
		Schema::drop('first_spesifications');
	}

}
