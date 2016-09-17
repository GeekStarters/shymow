<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentSharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_shares', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comment_post_id')->unsigned();
			$table->foreign('comment_post_id')->references('id')->on('comment_posts')->onDelete('cascade');
			$table->integer('profil_id')->unsigned();
			$table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
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
		Schema::drop('comment_shares');
	}

}
