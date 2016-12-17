<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coment_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->integer('profil_id')->unsigned();
			$table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
			$table->string('description');
			$table->integer('like')->default(0);
			$table->integer('qualification')->default(0);
			$table->integer('posts')->default(0);
			$table->integer('share')->default(0);
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
		Schema::drop('coment_products');
	}

}
