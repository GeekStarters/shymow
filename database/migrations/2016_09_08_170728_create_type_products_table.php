<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('type_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_product_id')->unsigned();
			$table->foreign('category_product_id')->references('id')->on('category_products')->onDelete('cascade');
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
		Schema::drop('type_products');
	}

}
