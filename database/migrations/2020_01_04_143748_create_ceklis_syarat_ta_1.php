<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeklisSyaratTa1 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ceklis_syarat_ta_1', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('file_name', 100);
			$table->string('created_by', 50);
			$table->string('updated_by', 50)->nullable();
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
		Schema::drop('ceklis_syarat_ta_1');
	}

}
