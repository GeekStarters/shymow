<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('business_sub_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('business_id')->unsigned()->index();
			$table->foreign('business_id')->references('id')->on('business_categories')->onDelete('cascade');
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
		Schema::drop('business_sub_categories');
	}

}
