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
			$table->string('email')->nullable()->unique();
			$table->string('password', 60);
			$table->date('birthdate');
			$table->string('genero');
			$table->string('pais');
			$table->string('provincia');
			$table->string('municipio');
			$table->string('work');
			$table->string('phone');
			$table->integer('role');
			$table->integer('edad');
			$table->string('img_profile')->default('img/profile/default.png');
			$table->string('img_portada')->default('img/profile/portada.jpg');
			$table->string('hobbies')->nullable();
			$table->string('redes')->nullable();
			$table->string('streamings')->nullable();
			$table->string('webs')->nullable();
			$table->string('blogs')->nullable();
			$table->string('mi_frase')->default('¡Bienvenid@ a Shymow!');
			$table->string('descripcion')->default('Edita tu descripción');
			$table->boolean('active')->default(true);
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