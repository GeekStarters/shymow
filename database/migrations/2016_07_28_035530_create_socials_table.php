<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('socials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profile_id')->unsigned();
			$table->foreign('profile_id')->references('id')->on('perfils')->onDelete('cascade');
            $table->string('provider', 32);
            $table->text('social_id');
            $table->text('access_token');
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
		Schema::drop('socials');
	}

}
