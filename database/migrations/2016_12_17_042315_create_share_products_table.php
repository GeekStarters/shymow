<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('share_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->integer('profil_id')->unsigned();
			$table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');

			$table->integer('new_product_id')->unsigned();
			$table->foreign('new_product_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('new_profil_id')->unsigned();
			$table->foreign('new_profil_id')->references('id')->on('profils')->onDelete('cascade');

			$table->string('description_old_product')->nullable();
			
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
		Schema::drop('share_products');
	}

}
