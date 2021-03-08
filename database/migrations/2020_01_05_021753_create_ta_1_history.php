<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTa1History extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ta_1_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim', 20);			
			$table->dateTime('jadwal')->nullable();
			$table->integer('id_status_ta_1')->default(1);
			$table->string('ruangan', 60)->nullable();
			$table->string('created_by', 50);				
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
		Schema::drop('ta_1_history');
	}

}
