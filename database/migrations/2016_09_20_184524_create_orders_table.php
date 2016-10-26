<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->integer('perfil_id')->unsigned();
			$table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
			$table->string('address_city');
			$table->string('address_country');
			$table->string('address_name');
			$table->string('address_status');
			$table->string('address_street');
			$table->string('address_zip');
			$table->string('business');
			$table->string('first_name');
			$table->string('last_name');
			$table->decimal('handling_amount', 5, 2);
			$table->string('item_name');
			$table->string('mc_currency');
			$table->string('payer_email');
			$table->string('payer_id');
			$table->string('payer_status');
			$table->string('payment_date');
			$table->string('payment_status');
			$table->string('receiver_email');
			$table->string('receiver_id');
			$table->integer('quantity');
			$table->decimal('shipping', 8, 2);
			$table->decimal('payment_fee', 8, 2);
			$table->decimal('payment_gross', 8, 2);
			$table->decimal('mc_fee', 8, 2);
			$table->decimal('mc_gross', 8, 2);
			$table->string('txn_id');
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
		Schema::drop('orders');
	}

}
