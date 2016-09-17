<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profile_id')->unsigned();
			$table->foreign('profile_id')->references('id')->on('perfils')->onDelete('cascade');;
			$table->string('responsable')->nullable();
			$table->string('email_responsable')->nullable();
			$table->string('empresa');
			$table->string('alias');
			$table->string('dni');
			$table->string('actividad_comercial');
			$table->string('descripcion');
			$table->string('empresa_pais');
			$table->string('empresa_provincia');
			$table->string('empresa_municipio');
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
		Schema::drop('empresas');
	}

}
