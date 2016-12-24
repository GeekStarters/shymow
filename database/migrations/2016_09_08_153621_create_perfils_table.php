<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perfils', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('fname')->nullable();
			$table->string('lname')->nullable();
			$table->string('email')->nullable()->unique();
			$table->string('password', 60);
			$table->string('identification', 60)->nullable();
			$table->string('confirmation_code', 60)->nullable();
			$table->date('birthdate');
			$table->string('genero');
			$table->string('pais');
			$table->string('provincia');
			$table->string('municipio');
			$table->string('recover_pass')->nullable()->unique();
			$table->string('work');
			$table->string('code_phone')->nullable();
			$table->string('phone')->nullable();
			$table->string('cp')->nullable();
			$table->integer('role');
			$table->integer('edad');
			$table->string('img_profile')->default('img/profile/default.png');
			$table->string('img_portada')->default('img/profile/portada.jpg');
			$table->mediumText('hobbies')->nullable();
			$table->mediumText('more_hobbies')->nullable();
			$table->mediumText('redes')->nullable();
			$table->mediumText('streamings')->nullable();
			$table->mediumText('webs')->nullable();
			$table->mediumText('blogs')->nullable();
			$table->string('mi_frase')->default('¡Bienvenid@ a Shymow!');
			$table->string('descripcion')->default('Edita tu descripción');
			$table->integer('like')->default(0);
			$table->integer('qualification')->default(0);
			$table->boolean('view_email')->default(true);
			$table->boolean('is_youtuber')->default(false);
			$table->boolean('update')->default(false);
			$table->boolean('view_phone')->default(true);
			$table->boolean('view_cp')->default(true);
			$table->boolean('view_country')->default(true);
			$table->boolean('view_gender')->default(true);
			$table->boolean('view_birth')->default(true);
			$table->boolean('active')->default(true);
			$table->boolean('policies_and_conditions')->default(true);
			$table->boolean('confirmed')->default(false);
			$table->rememberToken();
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
		Schema::drop('perfils');

	}

}
