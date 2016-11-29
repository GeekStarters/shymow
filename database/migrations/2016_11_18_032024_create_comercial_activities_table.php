<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComercialActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comercial_activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('search_categorie_id')->unsigned();
			$table->foreign('search_categorie_id')->references('id')->on('search_categories')->onDelete('cascade');
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
		Schema::drop('comercial_activities');
	}

}
