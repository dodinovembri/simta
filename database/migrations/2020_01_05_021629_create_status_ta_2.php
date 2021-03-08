<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTa2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status_ta_2', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('status_ta_2', 60);			
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
		Schema::drop('status_ta_2');
	}

}
