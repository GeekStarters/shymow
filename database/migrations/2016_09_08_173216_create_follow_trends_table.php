<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowTrendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('follow_trends', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('perfil_id')->unsigned();
			$table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
			$table->integer('trend_id')->unsigned();
			$table->foreign('trend_id')->references('id')->on('trends')->onDelete('cascade');
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
		Schema::drop('follow_trends');
	}

}
