<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned();
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
			$table->integer('profile_id')->unsigned();
			$table->foreign('profile_id')->references('id')->on('perfils')->onDelete('cascade');
			$table->string('title');
			$table->string('description');
			$table->decimal('price', 6, 2);
			$table->integer('stock');
			$table->integer('send_type');
			$table->boolean('active')->default(true);
			$table->boolean('garantia');
			$table->integer('category_product_id')->unsigned();
			$table->foreign('category_product_id')->references('id')->on('category_products')->onDelete('cascade');
			$table->integer('type_product_id')->unsigned();
			$table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');
			$table->integer('first_spesification_id')->unsigned();
			$table->foreign('first_spesification_id')->references('id')->on('first_spesifications')->onDelete('cascade');
			$table->integer('last_spesification_id')->unsigned();
			$table->foreign('last_spesification_id')->references('id')->on('last_spesifications')->onDelete('cascade');
			$table->integer('comments')->default(0);
			$table->integer('qualification')->default(0);
			$table->integer('like')->default(0);
			$table->integer('share')->default(0);
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
		Schema::drop('products');
	}

}
